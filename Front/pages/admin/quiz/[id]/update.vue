<template>
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