<template>
<<<<<<< HEAD
    <form action="/" method="post" class="bg-bg-primary p-6 rounded-md shadow-lg flex flex-col gap-4 w-3xl" @submit.prevent="submit">
        <div class="flex flex-row justify-between">
            <label for="title" class="font-bold text-yellow-500">Titre</label>
        </div>
        <input type="text" id="title" name="title" class="border-2 border-solid border-bg-secondary p-2 rounded-md" v-model="tab.title">

        <div v-for="(question, questionIndex) in tab.questions" :key="questionIndex" class="rounded-lg p-6 shadow-sm flex flex-col gap-8 w-96 border-2 border-solid border-bg-secondary w-full">
            <div class="flex flex-col gap-2">
                <div class="flex flex-row justify-between">
                    <label :for="'question-' + questionIndex" class="font-bold">Question {{ questionIndex + 1 }}</label>
                    <button v-if="tab.questions.length > 1" class="text-red-400" @click.prevent="removeQuestion(questionIndex)">Supprimer la question</button>
                    <button v-else disabled class="text-red-200" @click.prevent="removeQuestion(questionIndex)">Supprimer la question</button>
                </div>
                <input type="text" :id="'question-' + questionIndex" v-model="question.label" class="border-2 border-solid border-bg-secondary p-2 rounded-md" placeholder="Ecrire ici">

                <hr class="my-4">

                <div v-for="(answer, answerIndex) in question.answers" :key="answerIndex" class="flex flex-col gap-2">
                    <div class="flex flex-row justify-between">
                        <label :for="'answer-' + questionIndex + '-' + answerIndex">Réponse {{ answerIndex + 1 }}</label>
                        <button v-if="question.answers.length > 2" class="text-red-400" @click.prevent="removeAnswer(questionIndex, answerIndex)">Supprimer la réponse</button>
                        <button v-else disabled class="text-red-200" @click.prevent="removeAnswer(questionIndex, answerIndex)">Supprimer la réponse</button>
                    </div>
                    <input type="text" :id="'answer-' + questionIndex + '-' + answerIndex" v-model="answer.label" class="border-2 border-solid border-bg-secondary p-2 w-full rounded-md" placeholder="Ecrire ici">
                    
                    <div class="flex items-center gap-4 mb-4">
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
=======
    <form action="/" method="post" class="flex flex-col gap-4">
        <label for="title" class="font-bold text-yellow-500">Titre</label>
        <input type="text" id="title" name="title" class="border-2 border-solid border-solid p-2 rounded-md" value="Ceci est un quiz">

        <div class="bg-white p-6 rounded-lg shadow-sm flex flex-col gap-8 w-96">
            <div class="flex flex-col gap-2">
                <label for="question" class="font-bold">Question {{ currentQuestion + 1 }}</label>
                <input type="text" id="question" name="question" class="border-2 border-solid p-2" :value="tab[currentQuestion].question">

                <label for="answere1">Réponse 1</label>
                <input type="text" id="answere1" name="answere1" class="border-2 border-solid p-2" :value="tab[currentQuestion].reponses[0]">
                
                <label for="answere2">Réponse 2</label>
                <input type="text" id="answere2" name="answere2" class="border-2 border-solid p-2" :value="tab[currentQuestion].reponses[1]">

                <label for="answere3">Réponse 3</label>
                <input type="text" id="answere3" name="answere3" class="border-2 border-solid p-2" :value="tab[currentQuestion].reponses[2]">

                <label for="answere4">Réponse 4</label>
                <input type="text" id="answere4" name="answere4" class="border-2 border-solid p-2" :value="tab[currentQuestion].reponses[3]">
                
                <!-- Ajouter un bouton pour ajouter des réponses -->
                <!-- Si on est sur la derniere question mettre un bouton ajouter une question à la place de suivant -->

                <div class="flex flex-row gap-8 justify-between mt-8">
                    <ButtonDefaultForm @click.prevent="prevQuestion">Precedent</ButtonDefaultForm>
                    <ButtonDefaultForm @click.prevent="nextQuestion">Suivant</ButtonDefaultForm>
                </div>
            </div>
        </div>

        <button type="submit" class="bg-white border-2 border-solid border-yellow-300 py-2 rounded-lg text-yellow-400 hover:bg-yellow-300 hover:text-black">Envoyer</button>
>>>>>>> cc4f645 (J'ai fais le CSS de la page update et j'ai essayé de faire un début de logique d'update. (J'ai oublié de faire un commit avant dsl))
    </form>
</template>

<script setup>
<<<<<<< HEAD
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
=======
const tab = [
    {
        question: "Comment ça va ?",
        reponses: [
            "Bien",
            "Mal",
            "Oui",
            "Toi je t'aime pas"
        ]
    },
    {
        question: "Comment tu t'appelles ?",
        reponses: [
            "Jean",
            "Paul",
            "Jacques",
            "Marie"
        ]
    }
];

import { ref, computed, onMounted } from 'vue';
import { useRoute } from 'vue-router';
import { fetchQuizById } from '../../../../utils/fetchQuiz';
import { fetchQuestions } from '../../../../utils/fetchQuestions';
import { fetchReponses } from '../../../../utils/fetchReponses';

const route = useRoute();

const id = computed(() => route.params.id);

const quiz = ref(null);
const currentQuestion = ref(0);

const nextQuestion = () => {
    if (currentQuestion.value < tab.length - 1) {
        currentQuestion.value++;
    }
};

const prevQuestion = () => {
    if (currentQuestion.value < tab.length + 1) {
        currentQuestion.value--;
    }
}

onMounted(async () => {
    try {
        quiz.value = await fetchQuizById(id.value);
        questions.value = await fetchQuestions(id.value);
        if (questions.value && questions.value.length > 0) {
            reponses.value = await fetchReponses(questions.value[currentQuestion.value].id_question);
        }
    } catch (error) {
        console.error(error);
>>>>>>> cc4f645 (J'ai fais le CSS de la page update et j'ai essayé de faire un début de logique d'update. (J'ai oublié de faire un commit avant dsl))
    }
});
</script>