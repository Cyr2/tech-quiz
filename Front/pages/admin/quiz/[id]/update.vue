<template>
    <form action="/" method="post" class="flex flex-col gap-4 w-3xl">
        <div class="flex flex-row justify-between">
            <label for="title" class="font-bold text-yellow-500">Titre</label>
            <button class="text-red-400">Supprimer le quiz</button>
        </div>
        <input type="text" id="title" name="title" class="border-2 border-solid border-solid p-2 rounded-md" value="Ceci est un quiz">

        <div class="bg-white rounded-lg p-6 shadow-sm flex flex-col gap-8 w-96 border-2 border-solid w-full">
            <div class="flex flex-col gap-2">
                <div class="flex flex-row justify-between">
                    <label for="question" class="font-bold">Question {{ currentQuestion + 1 }}</label>
                    <button class="text-red-400">Supprimer</button>
                </div>
                <input type="text" id="question" name="question" class="border-2 border-solid p-2" :value="tab[currentQuestion].question">

                <div class="flex flex-row justify-between">
                    <label for="answere1">Réponse 1</label>
                    <button class="text-red-400">Supprimer</button>
                </div>
                <input type="text" id="answere1" name="answere1" class="border-2 border-solid p-2" :value="tab[currentQuestion].reponses[0]">
                
                <div class="flex flex-row justify-between">
                    <label for="answere1">Réponse 2</label>
                    <button class="text-red-400">Supprimer</button>
                </div>
                <input type="text" id="answere2" name="answere2" class="border-2 border-solid p-2" :value="tab[currentQuestion].reponses[1]">

                <div class="flex flex-row justify-between">
                    <label for="answere1">Réponse 3</label>
                    <button class="text-red-400">Supprimer</button>
                </div>
                <input type="text" id="answere3" name="answere3" class="border-2 border-solid p-2" :value="tab[currentQuestion].reponses[2]">

                <div class="flex flex-row justify-between">
                    <label for="answere1">Réponse 1</label>
                    <button class="text-red-400">Supprimer</button>
                </div>
                <input type="text" id="answere4" name="answere4" class="border-2 border-solid p-2" :value="tab[currentQuestion].reponses[3]">

                <button class="flex text-gray-400 mt-2">+ Ajouter une réponse</button>
                
                <!-- Ajouter un bouton pour ajouter des réponses -->
                <!-- Si on est sur la derniere question mettre un bouton ajouter une question à la place de suivant -->

                <div class="flex flex-row gap-8 justify-between mt-6">
                    <button @click.prevent="prevQuestion" class="bg-yellow-400 p-6 rounded-lg h-8 w-96 flex items-center justify-center">Precedent</button>
                    <button
                        v-if="!LastQuestion" 
                        @click.prevent="nextQuestion" 
                        class="bg-yellow-400 p-6 rounded-lg h-8 w-96 flex items-center justify-center">
                        Suivant
                    </button>
                    <button 
                        v-if="LastQuestion" 
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

const test = 2;

const LastQuestion = computed(() => currentQuestion.value === tab.length - 1);

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
    }
});
</script>