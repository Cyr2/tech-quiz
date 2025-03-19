<template>
  <div>
    <div v-if="questions && reponses">
      <hgroup>
        <p>Question {{ currentQuestion + 1 }} / {{ questions.length }}</p>
        <h1 class="uppercase">{{ name }}</h1>
      </hgroup>
      <div class="progress-bar">
        <div class="progress" :style="{ width: `${((currentQuestion + 1) / questions.length) * 100}%` }"></div>
      </div>
      <div>
        <p>{{ questions[currentQuestion].label }}</p>
        <ul :class="validatedReponse !== null ? 'pointer-events-none' : ''">
          <InputDefault v-for="reponse in reponses" :key="reponse.id_reponse" :reponse="reponse" :selectedReponse="selectedReponse" :updateSelectedReponse="updateSelectedReponse" :validatedReponse="validatedReponse"/>
        </ul>
        <button v-if="validatedReponse === null" :disabled="!selectedReponse" @click="validateQuestion" class="cursor-pointer disabled:cursor-default">Valider</button>
        <button v-else-if="currentQuestion < questions.length - 1" @click="nextQuestion" class="cursor-pointer">Suivant</button>
        <button v-else @click="submitQuiz" class="cursor-pointer">Terminer</button>
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

const updateSelectedReponse = (id_reponse) => {
  selectedReponse.value = id_reponse;
};

const validateQuestion = () => {
  if(selectedReponse) {
    validatedReponse.value = reponses.value.find((reponse) => reponse.id_reponse === selectedReponse.value).is_correct;

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
  
}

onMounted(async () => {
  try {
    questions.value = await fetchQuestions(id.value);
    if (questions.value && questions.value.length > 0) {
      reponses.value = await fetchReponses(questions.value[currentQuestion.value].id_question);
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
