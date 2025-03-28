<template>
    <form action="/" method="post" class="bg-bg-primary p-6 rounded-md shadow-lg flex flex-col gap-4 w-3xl" @submit.prevent="submit">
        <div class="flex flex-row justify-between">
            <label for="title" class="font-bold text-yellow-500">Titre</label>
        </div>
        <input type="text" id="title" name="title" class="border-2 border-solid border-bg-secondary p-2 rounded-md" v-model="tab.title" placeholder="Ecrire ici" @input="verifQuiz">
        <p v-if="errorQuiz">{{ errorQuiz }}</p>

        <div v-for="(question, questionIndex) in tab.questions" :key="questionIndex" class="rounded-lg p-6 shadow-sm flex flex-col gap-8 w-96 border-2 border-solid border-bg-secondary w-full">
            <div class="flex flex-col gap-2">
                <div class="flex flex-row justify-between">
                    <label :for="'question-' + questionIndex" class="font-bold">Question {{ questionIndex + 1 }}</label>
                    <button v-if="tab.questions.length > 1" class="text-red-400" @click.prevent="removeQuestion(questionIndex)">Supprimer la question</button>
                    <button v-else disabled class="text-red-200" @click.prevent="removeQuestion(questionIndex)">Supprimer la question</button>
                </div>
                <input type="text" :id="'question-' + questionIndex" v-model="question.label" class="border-2 border-solid border-bg-secondary p-2 rounded-md" placeholder="Ecrire ici" @input="verifQuestion">
                <p v-if="errorQuestion">{{ errorQuestion }}</p>

                <hr class="my-4">

                <div v-for="(answer, answerIndex) in question.answers" :key="answerIndex" class="flex flex-col gap-2">
                    <div class="flex flex-row justify-between">
                        <label :for="'answer-' + questionIndex + '-' + answerIndex">Réponse {{ answerIndex + 1 }}</label>
                        <button v-if="question.answers.length > 2" class="text-red-400" @click.prevent="removeAnswer(questionIndex, answerIndex)">Supprimer la réponse</button>
                        <button v-else disabled class="text-red-200" @click.prevent="removeAnswer(questionIndex, answerIndex)">Supprimer la réponse</button>
                    </div>
                    <input type="text" :id="'answer-' + questionIndex + '-' + answerIndex" v-model="answer.label" class="border-2 border-solid border-bg-secondary p-2 w-full rounded-md" placeholder="Ecrire ici" @input="verifAnswer(questionIndex)">
                    <p v-if="errorAnswer">{{ errorAnswer }}</p>
                    
                    <div class="flex items-center gap-4 mb-4" v-if="answer.isCorrect">
                        <label :for="'isCorrect-' + questionIndex + '-' + answerIndex">Réponse correcte</label>
                        <input type="radio" :name="'isCorrect-' + questionIndex" :id="'isCorrect-' + questionIndex + '-' + answerIndex" v-model="question.correctAnswer" :value="answerIndex" checked>
                    </div>

                    <div class="flex items-center gap-4 mb-4" v-else>
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

            <button
                v-else
                disabled
                @click.prevent="addQuestion"
                class="bg-gray-200 text-gray-400 p-6 rounded-lg h-8 w-96 flex items-center justify-center">
                Ajouter une question
            </button>
        </div>

        <button 
            type="submit" 
            class="border-2 border-solid border-gray-200 hover:border-yellow-400 py-2 rounded-lg hover:bg-yellow-400"
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
import { fetchDeleteAnswer } from '../../../../utils/fetchDeleteAnswer';
import { fetchDeleteQuestion } from '../../../../utils/fetchDeleteQuestion';

const route = useRoute();
const id = computed(() => route.params.id);

const errorQuiz = ref('');
const errorQuestion = ref('');
const errorAnswer = ref('');
const answerDelete = ref([]);
const questionDelete = ref([]);

const tab = ref({
    title: '',
    questions: [
        {
            questionId: '',
            correctAnswer: null,
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
        questionId: crypto.randomUUID(),
        label: '',
        correctAnswer: null,
        answers: [
            { label: '', isCorrect: false, answerId: crypto.randomUUID() },
            { label: '', isCorrect: false, answerId: crypto.randomUUID() },
        ],
    });
};

const removeQuestion = (index) => {
    if (tab.value.questions.length > 1) {
        questionDelete.value.push(tab.value.questions[index].questionId);
        tab.value.questions.splice(index, 1);
    }
};

const addAnswer = (questionIndex) => {
    if (tab.value.questions[questionIndex].answers.length < 4) {
        tab.value.questions[questionIndex].answers.push({ label: '', isCorrect: false, answerId: crypto.randomUUID() });
    }
};

const removeAnswer = (questionIndex, answerIndex) => {
    if (tab.value.questions[questionIndex].answers.length > 2) {
        answerDelete.value.push(tab.value.questions[questionIndex].answers[answerIndex].answerId);
        tab.value.questions[questionIndex].answers.splice(answerIndex, 1);

    }
};

const verifQuiz = () => {
    if (tab.value.title.trim() === '') {
        errorQuiz.value = 'Le titre ne peut pas être vide';
        return false;
    } else {
        errorQuiz.value = '';
    }
};

const verifQuestion = () => {
    for (let i = 0; i < tab.value.questions.length; i++) {
        const question = tab.value.questions[i];
        if (question.label.trim() === '') {
            errorQuestion.value = `La question ${i + 1} ne peut pas être vide`;
            return false;
        }
    }
    errorQuestion.value = '';
    return true;
};

const verifAnswer = (questionIndex) => {
    const question = tab.value.questions[questionIndex];
    for (let j = 0; j < question.answers.length; j++) {
        const answer = question.answers[j];
        if (answer.label.trim() === '') {
            errorAnswer.value = `La réponse ${j + 1} de la question ${questionIndex + 1} ne peut pas être vide`;
            return false;
        }
    }
    errorAnswer.value = '';
    return true;
};

const submit = async () => {
    if (tab.value.title.trim() === ''){
        errorQuiz.value = 'Le titre ne peut pas être vide';
        return;
    }
    if (tab.value.questions.some((q) => q.label.trim() === '')){
        errorQuestion.value = 'Toutes les questions doivent avoir un libellé.';
        return;
    }
    if (tab.value.questions.some((q) => q.answers.some((a) => a.label.trim() === ''))){
        errorAnswer.value = 'Toutes les réponses doivent avoir un libellé.';
        return;
    }

    if(answerDelete.value.length > 0){
        for (const answerId of answerDelete.value) {
            await fetchDeleteAnswer(answerId);
        }
    }

    if(questionDelete.value.length > 0){
        for (const questionId of questionDelete.value) {
            await fetchDeleteQuestion(questionId);
        }
    }

    const transformedQuiz = {
        title: tab.value.title,
        questions: tab.value.questions.map((question) => {
            return {
                questionId: question.questionId,
                label: question.label,
                answers: question.answers.map((answer, index) => {
                    return {
                        answerId: answer.answerId, // Ajout de l'ID de la réponse
                        label: answer.label,
                        isCorrect: index === question.correctAnswer ? 1 : 0, // Marque la réponse correcte avec 1 ou 0
                    };
                }),
            };
        }),
    };

    const date = new Date().toISOString().split('T')[0];
    console.log(transformedQuiz);
    const response = await fetchUpdateQuiz(id.value, transformedQuiz, date);
    navigateTo('/admin/quiz');
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
                console.log(answersData);
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