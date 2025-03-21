<template>
  <div class="h-full flex flex-col gap-16">
    <h1 class="uppercase">{{ name }}</h1>
    <div v-if="questions && reponses" class="flex justify-between gap-16 max-md:flex-col">
      <div class="flex flex-col justify-between w-1/2 pb-20 gap-8 max-md:w-full">
        <hgroup class="flex flex-col gap-4">
          <p class="italic text-gray-500">Question {{ currentQuestion + 1 }} / {{ questions.length }}</p>
          <p class="text-2xl font-bold">{{ questions[currentQuestion].label }}</p>
        </hgroup>
        <UProgress :value="currentQuestion + 1" :max="questions.length" color="yellow" />
      </div>
      <div class="w-1/2 max-md:w-full flex flex-col gap-6">
        <ul :class="validatedReponse !== null ? 'pointer-events-none' : ''" class="flex flex-col w-full gap-4">
          <InputDefault v-for="(reponse, index) in reponses" :key="reponse.id_reponse" :reponse="reponse" :selectedReponse="selectedReponse" :updateSelectedReponse="updateSelectedReponse" :letter="String.fromCharCode(65 + index)" :validatedReponse="validatedReponse" :correctReponse="correctReponse"/>
        </ul>
        <ButtonDefaultForm v-if="validatedReponse === null" :click="validateQuestion" :disabled="!selectedReponse">Valider</ButtonDefaultForm>
        <ButtonDefaultForm v-else-if="currentQuestion < questions.length - 1" :click="nextQuestion">Suivant</ButtonDefaultForm>
        <ButtonDefaultForm v-else :click="submitQuiz">Terminer</ButtonDefaultForm>
      </div>
    </div>
    <div v-else>
      <p>Chargement...</p>
    </div>
  </div>
</template>

<script setup>
import { useRoute } from 'vue-router';
import { computed, ref, onMounted } from 'vue';
import { fetchQuestions } from '../../../utils/fetchQuestions';
import { fetchReponses } from '../../../utils/fetchReponses';

const route = useRoute();

const name = computed(() => route.params.name);
const id = computed(() => route.params.id);

const questions = ref(null);
const score = ref(0);
const currentQuestion = ref(0);
const reponses = ref(null);
const selectedReponse = ref(null);
const validatedReponse = ref(null);
const correctReponse = ref(null);

const updateSelectedReponse = (id_reponse) => {
  selectedReponse.value = id_reponse;
};

const validateQuestion = () => {
  if(selectedReponse) {
    validatedReponse.value = reponses.value.find((reponse) => reponse.id_reponse === selectedReponse.value).isCorrect;

    if (validatedReponse) {
      score.value++;
    }
  }
};

const nextQuestion = async () => {
  validatedReponse.value = null;
  selectedReponse.value = null;
  currentQuestion.value++;
  reponses.value = await fetchReponses(questions.value[currentQuestion.value].id_question);
  correctReponse.value = reponses.value.find((reponse) => reponse.isCorrect).id_reponse;
  
}

onMounted(async () => {
  try {
    questions.value = await fetchQuestions(id.value);
    if (questions.value && questions.value.length > 0) {
      reponses.value = await fetchReponses(questions.value[currentQuestion.value].id_question);
      correctReponse.value = reponses.value.find((reponse) => reponse.isCorrect).id_reponse;
    }
  } catch (error) {
    console.error('Erreur lors du chargement:', error);
  }
});
</script>

<style scoped>
.progress-bar {
  width: 100%;
  height: 4px;
  background-color: #e2e8f0;
  border-radius: 2px;
  margin: 1rem 0;
}

.progress {
  height: 100%;
  background-color: #3b82f6;
  border-radius: 2px;
  transition: width 0.3s ease;
}
</style>
