<template>
    <form action="/" method="post" class="flex flex-col gap-4 w-3xl">
        <div class="flex flex-row justify-between">
            <label for="title" class="font-bold text-yellow-500">Titre</label>
            <button class="text-red-400">Supprimer le quiz</button>
        </div>
        <input type="text" id="title" name="title" class="border-2 border-solid border-solid p-2 rounded-md" :value="tab.title">

        <div class="bg-white rounded-lg p-6 shadow-sm flex flex-col gap-8 w-96 border-2 border-solid w-full">
            <div class="flex flex-col gap-2">
                <div class="flex flex-row justify-between">
                    <label for="question" class="font-bold">Question {{ currentQuestion + 1 }}</label>
                    <button class="text-red-400" @click.prevent="removeQuestion(currentQuestion)">Supprimer la question</button>
                </div>
                <input type="text" id="question" name="question" class="border-2 border-solid p-2" v-model="tab.questions[currentQuestion].label">

                <div v-for="(answer, index) in tab.questions[currentQuestion].answers" :key="index" class="flex flex-col gap-2">
                    <div class="flex flex-row justify-between">
                        <label :for="'answer' + index">Réponse {{ index + 1 }}</label>
                        <button class="text-red-400" @click.prevent="removeAnswer(currentQuestion, index)">Supprimer la réponse</button>
                    </div>
                    <div class="flex flex-col items-start gap-2">
                        <input type="text" :id="'answer' + index" :name="'answer' + index" class="border-2 border-solid p-2 w-full" v-model="answer.label">
                        <div class="flex gap-4 mb-4" v-if="answer.isCorrect">
                            <label :for="'isCorrect' + index">Réponse correcte</label>
                            <input type="radio" name="isCorrect" :id="'isCorrect' + index" checked>
                        </div>
                        <div class="flex gap-4 mb-4" v-else>
                            <label :for="'isCorrect' + index">Réponse correcte</label>
                            <input type="radio" name="isCorrect" :id="'isCorrect' + index">
                        </div>
                    </div>
                </div>

                <button class="flex text-gray-400 mt-2" @click.prevent="addAnswer(currentQuestion)">+ Ajouter une réponse</button>

                <div class="flex flex-row gap-8 justify-between mt-6">
                    <button 
                        v-if="currentQuestion === 0"
                        @click.prevent="prevQuestion" 
                        class="bg-gray-200 p-6 rounded-lg h-8 w-96 flex items-center justify-center"
                        disabled="true">
                        Precedent
                    </button>
                    <button 
                        v-else
                        @click.prevent="prevQuestion" 
                        class="bg-yellow-400 p-6 rounded-lg h-8 w-96 flex items-center justify-center">
                        Precedent
                    </button>

                    <button
                        v-if="!LastQuestion" 
                        @click.prevent="nextQuestion" 
                        class="bg-yellow-400 p-6 rounded-lg h-8 w-96 flex items-center justify-center">
                        Suivant
                    </button>
                    <button 
                        v-else
                        @click.prevent="addQuestion"
                        class="bg-yellow-400 p-6 rounded-lg h-8 w-96 flex items-center justify-center">
                        Ajouter une question
                    </button>
                </div>
            </div>
        </div>

        <button type="submit" class="bg-white border-2 border-solid border-yellow-400 py-2 rounded-lg text-yellow-500 hover:bg-yellow-400 hover:text-black">Enregistrer</button>
    </form>
</template>

<script setup>

import { ref, computed, onMounted } from 'vue';
import { useRoute } from 'vue-router';
import { fetchQuizById } from '../../../../utils/fetchQuizById';
import { fetchQuestionsByIdQuiz } from '../../../../utils/fetchQuestionsByIdQuiz';
import { fetchAnswersByIdQuestion } from '../../../../utils/fectAnswersByIdQuestion';


const route = useRoute();

const id = computed(() => route.params.id);


const tab = ref({
    title: 'Nouveau quiz',
    questions: [
        {
            label: 'Comment ça va ?',
            answers: [
                { label: 'Bien', isCorrect: "on" },
                { label: 'Mal', isCorrect: false },
                { label: 'Oui', isCorrect: false },
                { label: 'Toi je t\'aime pas', isCorrect: false }
            ],
        },
        {
            label: 'Comment tu t\'appelles ?',
            answers: [
                { label: 'Jean', isCorrect: false },
                { label: 'Paul', isCorrect: false },
                { label: 'Jacques', isCorrect: false },
                { label: 'Je sais pas', isCorrect: "on" }
            ],
        }
    ],
});

const currentQuestion = ref(0);

const LastQuestion = computed(() => currentQuestion.value === tab.value.questions.length - 1);

const nextQuestion = () => {
    if (currentQuestion.value < tab.value.questions.length - 1) {
        currentQuestion.value++;
    }
};

const prevQuestion = () => {
    if (currentQuestion.value > 0) {
        currentQuestion.value--;
    }
};

const addQuestion = () => {
    tab.value.questions.push({
        label: 'Nouvelle question ?',
        answers: [
            { label: '', isCorrect: false },
            { label: '', isCorrect: false },
        ],
    });
    currentQuestion.value = tab.value.questions.length - 1;
};

const removeQuestion = (index) => {
    if (tab.value.questions.length > 1) {
        tab.value.questions.splice(index, 1);
        currentQuestion.value = Math.max(0, currentQuestion.value - 1);
    }
};

const addAnswer = (questionIndex) => {
    if(tab.value.questions[questionIndex].answers.length >= 4) return;
    tab.value.questions[questionIndex].answers.push({ label: '', isCorrect: false });
};
 
const removeAnswer = (questionIndex, answerIndex) => {
    if (tab.value.questions[questionIndex].answers.length > 2) {
        tab.value.questions[questionIndex].answers.splice(answerIndex, 1);
    } 
};

onMounted(async () => {
        const quizData = await fetchQuizById(id.value);
        if(quizData){
            tab.value.title = quizData.title;
        }

        const questionsData = await fetchQuestionsByIdQuiz(id.value);
        if(questionsData){
            tab.value.questions = questionsData;
            console.log(tab.value.questions);
            
            for (let i = 0; i < tab.value.questions.length; i++) {
                console.log(tab.value.questions[i].quiz_id);
                const answersData = await fetchAnswersByIdQuestion(tab.value.questions[i].quiz_id);
                if(answersData){
                    console.log(answersData);
                    
                    tab.value.questions[i].answers = answersData;
                }
            }
        }
});
</script>