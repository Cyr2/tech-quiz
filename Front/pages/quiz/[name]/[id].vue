<template>
  <div class="h-full w-full flex flex-col gap-16">
    <h1 v-if="name" class="uppercase">{{ name }}</h1>
    <USkeleton v-else class="h-6 w-full" />
    <div class="flex justify-between gap-16 max-md:flex-col">
      <div class="flex flex-col justify-between w-1/2 pb-20 gap-8 max-md:w-full">
        <hgroup class="flex flex-col gap-4">
          <p v-if="currentQuestion !== null && questions && questions.length" class="italic text-gray-500">
            Question {{ currentQuestion + 1 }} / {{ questions.length }}
          </p>
          <USkeleton v-else class="h-6 w-full" />
          <p v-if="questions && questions[currentQuestion] && questions[currentQuestion].label" class="text-2xl font-bold">
            {{ questions[currentQuestion].label }}
          </p>
          <USkeleton v-else class="h-8 w-full" />
        </hgroup>
        <UProgress v-if="questions && questions.length" :value="currentQuestion + 1" :max="questions.length" color="yellow" />
        <USkeleton v-else class="h-2 w-full" />
      </div>
      <div v-if="reponses" class="w-1/2 max-md:w-full flex flex-col gap-6">
        <ul :class="validatedReponse !== null ? 'pointer-events-none' : ''" class="flex flex-col w-full gap-4">
          <InputDefault v-for="(reponse, index) in reponses" :key="reponse.answer_id" :reponse="reponse" :selectedReponse="selectedReponse" :updateSelectedReponse="updateSelectedReponse" :letter="String.fromCharCode(65 + index)" :validatedReponse="validatedReponse" :correctReponse="correctReponse"/>
        </ul>
        <ButtonDefaultForm v-if="validatedReponse === null" :click="validateQuestion" :disabled="!selectedReponse">Valider</ButtonDefaultForm>
        <ButtonDefaultForm v-else-if="currentQuestion < questions.length - 1" :click="nextQuestion">Suivant</ButtonDefaultForm>
        <ButtonDefaultForm v-else :click="submitQuiz">Terminer</ButtonDefaultForm>
      </div>
      <div v-else class="w-1/2 max-md:w-full flex flex-col gap-6">
        <ul class="flex flex-col w-full gap-4">
          <USkeleton class="h-12 w-full" />
          <USkeleton class="h-12 w-full" />
          <USkeleton class="h-12 w-full" />
          <USkeleton class="h-12 w-full" />
        </ul>
        <USkeleton class="h-14 w-full" />
      </div>
    </div>
  </div>
</template>

<script setup>
import { useRoute } from 'vue-router';
import { fetchQuestions } from '../../../utils/fetchQuestions';
import { fetchReponses } from '../../../utils/fetchReponses';
import { fetchStoreHistory } from '../../../utils/fetchStoreHistory';

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

const updateSelectedReponse = (answer_id) => {
  selectedReponse.value = answer_id;
};

const validateQuestion = () => {
  if (selectedReponse.value !== null) { // Ensure selectedReponse is checked correctly
    const selected = reponses.value.find((reponse) => reponse.answer_id === selectedReponse.value);
    validatedReponse.value = selected?.is_correct || false;

    if (validatedReponse.value) {
      score.value++;
    }
  }
};

const nextQuestion = async () => {
  validatedReponse.value = null;
  selectedReponse.value = null;
  currentQuestion.value++;
  getReponses();
}

const submitQuiz = async () => {
  try {
    const reponse = await fetchStoreHistory(score.value, id.value);
    console.log('Reponse:', reponse);
    navigateTo('/result/' + reponse.history.id);
  } catch (error) {
    console.error('Erreur lors de la soumission du quiz:', error);
    alert('Une erreur est survenue lors de la soumission. Veuillez réessayer plus tard.');
  }
};

const getReponses = async () => {
  if (questions.value && questions.value[currentQuestion.value]) {
    const currentQuestionId = questions.value[currentQuestion.value].question_id;

    reponses.value = null;
    correctReponse.value = null;

    reponses.value = await fetchReponses(currentQuestionId);
    correctReponse.value = reponses.value.find((reponse) => reponse.is_correct)?.answer_id || null;
  }
};

onMounted(async () => {
  try {
    questions.value = await fetchQuestions(id.value);
    if (questions.value && questions.value.length > 0) {
      getReponses();
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
