<template>
    <form action="/" method="post" class="flex flex-col gap-4 w-3xl" @submit.prevent="submit">
        <div class="flex flex-row justify-between">
            <label for="title" class="font-bold text-yellow-500">Titre</label>
        </div>
        <input type="text" id="title" name="title" class="border-2 border-solid p-2 rounded-md" v-model="tab.title">

        <div v-for="(question, questionIndex) in tab.questions" :key="questionIndex" class="bg-white rounded-lg p-6 shadow-sm flex flex-col gap-8 w-96 border-2 border-solid w-full">
            <div class="flex flex-col gap-2">
                <div class="flex flex-row justify-between">
                    <label :for="'question-' + questionIndex" class="font-bold">Question {{ questionIndex + 1 }}</label>
                    <button v-if="tab.questions.length > 1" class="text-red-400" @click.prevent="removeQuestion(questionIndex)">Supprimer la question</button>
                </div>
                <input type="text" :id="'question-' + questionIndex" v-model="question.label" class="border-2 border-solid p-2 rounded-md" placeholder="Ecrire ici">

                <div v-for="(answer, answerIndex) in question.answers" :key="answerIndex" class="flex flex-col gap-2">
                    <div class="flex flex-row justify-between">
                        <label :for="'answer-' + questionIndex + '-' + answerIndex">Réponse {{ answerIndex + 1 }}</label>
                        <button v-if="question.answers.length > 2" class="text-red-400" @click.prevent="removeAnswer(questionIndex, answerIndex)">Supprimer la réponse</button>
                    </div>
                    <input type="text" :id="'answer-' + questionIndex + '-' + answerIndex" v-model="answer.label" class="border-2 border-solid p-2 w-full rounded-md" placeholder="Ecrire ici">
                    
                    <div class="flex gap-4 mb-4">
                        <label :for="'isCorrect-' + questionIndex + '-' + answerIndex">Réponse correcte</label>
                        <input type="radio" :name="'isCorrect-' + questionIndex" :id="'isCorrect-' + questionIndex + '-' + answerIndex" v-model="question.correctAnswer" :value="answerIndex">
                    </div>
                </div>

                <button v-if="question.answers.length < 4" class="flex text-gray-400 mt-2" @click.prevent="addAnswer(questionIndex)">+ Ajouter une réponse</button>
            </div>
        </div>

        <div class="flex flex-row gap-8 justify-between mt-6">
            <NuxtLink to="/"
                class="bg-yellow-400 p-6 rounded-lg h-8 w-96 flex items-center justify-center">
                Annuler
            </NuxtLink>

            <button
                v-if="tab.questions.length < 10"
                @click.prevent="addQuestion"
                class="bg-yellow-400 p-6 rounded-lg h-8 w-96 flex items-center justify-center">
                Ajouter une question
            </button>
        </div>

        <button 
            type="submit" 
            class="bg-white border-2 border-solid border-yellow-400 py-2 rounded-lg text-yellow-500 hover:bg-yellow-400 hover:text-black"
            @click.prevent="submit">
            Enregistrer
        </button>
    </form>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue';
import { useRoute } from 'vue-router';
import { fetchQuizById } from '../../../../utils/fetchQuizById';
import { fetchQuestionsByIdQuiz } from '../../../../utils/fetchQuestionsByIdQuiz';
import { fetchAnswersByIdQuestion } from '../../../../utils/fectAnswersByIdQuestion';
import { fetchUpdateQuiz } from '../../../../utils/fetchUpdateQuiz';

const route = useRoute();
const id = computed(() => route.params.id);

const tab = ref({
    title: '',
    questions: [
        {
            questionId: '',
            label: '',
            answers: [
                { label: '', isCorrect: false, answerId: '' },
                { label: '', isCorrect: false, answerId: '' },
            ],
        },
    ],
});

const addQuestion = () => {
    tab.value.questions.push({
        questionId: '',
        label: '',
        answers: [
            { label: '', isCorrect: false, answerId: '' },
            { label: '', isCorrect: false, answerId: '' },
        ],
    });
};

const removeQuestion = (index) => {
    if (tab.value.questions.length > 1) {
        tab.value.questions.splice(index, 1);
    }
};

const addAnswer = (questionIndex) => {
    if (tab.value.questions[questionIndex].answers.length < 4) {
        tab.value.questions[questionIndex].answers.push({ label: '', isCorrect: false, answerId: '' });
    }
};

const removeAnswer = (questionIndex, answerIndex) => {
    if (tab.value.questions[questionIndex].answers.length > 2) {
        tab.value.questions[questionIndex].answers.splice(answerIndex, 1);
    }
};

const submit = async () => {
    if (tab.value.title === '') return alert('Le titre est requis.');
    if (tab.value.questions.some((q) => q.label === '')) return alert('Toutes les questions doivent avoir un libellé.');
    if (tab.value.questions.some((q) => q.answers.some((a) => a.label === ''))) return alert('Toutes les réponses doivent avoir un libellé.');

    const transformedQuiz = {
        ...tab.value,
        questions: tab.value.questions.map((question) => ({
            ...question,
            answers: question.answers.map((answer, _, answers) => {
                if (answer.isCorrect) {
                    answers.forEach((a) => (a.isCorrect = 0));
                    answer.isCorrect = 1;
                }
                return {
                    ...answer,
                    isCorrect: answer.isCorrect ? 1 : 0,
                };
            }),
        })),
    };

    const date = new Date().toISOString().split('T')[0];
    const response = await fetchUpdateQuiz(id.value, transformedQuiz, date);
    console.log(response);
};

onMounted(async () => {
    const quizData = await fetchQuizById(id.value);
    if (quizData) {
        tab.value.title = quizData.title;
    }

    const questionsData = await fetchQuestionsByIdQuiz(id.value);
    if (questionsData) {
        tab.value.questions = questionsData.map((question) => ({
            questionId: question.question_id,
            label: question.label,
            answers: [],
        }));

        for (const [index, question] of questionsData.entries()) {
            const answersData = await fetchAnswersByIdQuestion(question.question_id);
            if (answersData) {
                tab.value.questions[index].answers = answersData.map((answer) => ({
                    label: answer.label,
                    isCorrect: answer.is_correct,
                    answerId: answer.answer_id,
                }));
            }
        }
    }
});
</script>