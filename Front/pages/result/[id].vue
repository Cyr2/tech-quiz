<template>
  <div class="h-full w-2/3 flex flex-col gap-16 justify-between">
    <h1 class="uppercase" v-if="quiz">{{ quiz.title }}</h1>
    <h1 v-else>Loading...</h1>
    <div class="w-full flex gap-16 max-md:flex-col">
      <h2 class="text-5xl font-extralight w-full">
        Quiz completed
        <br> 
        <span class="font-bold">You scored...</span>
      </h2>
      <article class="flex flex-col gap-4 w-full">
        <div class="px-16 py-8 bg-bg-primary rounded-lg shadow-md flex flex-col gap-4 items-center">
          <p v-if="quiz">{{ quiz.title }}</p>
          <p v-else>Loading...</p>
          <p v-if="history" class="text-8xl font-bold">{{ history.score }}</p>
          <p v-else>Loading...</p>
          <p v-if="questions">out of {{ questions.length }}</p>
          <p v-else>Loading...</p>
        </div>
        <ButtonDefaultLink to="/">Retour à la liste des quiz</ButtonDefaultLink>
      </article>
    </div>
    <span></span>
  </div>
</template>

<script setup>
import { fetchHistory } from '../../utils/fetchHistory';
import { fetchQuiz } from '../../utils/fetchQuiz';
import { fetchQuestions } from '../../utils/fetchQuestions';

const route = useRoute();
const id_history = computed(() => route.params.id);

console.log(id_history.value);


const history = ref(null);
const quiz = ref(null);
const questions = ref(null);

onMounted(async () => {
  history.value = await fetchHistory(id_history.value);
  
  const allQuiz = await fetchQuiz();

  quiz.value = allQuiz.find((currQuiz) => currQuiz.id_quiz === history.value.quiz_id);

  questions.value = await fetchQuestions(history.value.quiz_id);
});
</script>

