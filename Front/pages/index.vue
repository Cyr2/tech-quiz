<template>
  <div class="flex justify-center gap-16 max-md:flex-col">
    <div class="flex flex-col space-y-8">
      <h1 class="text-5xl font-extralight">
        Welcom to the 
        <br> 
        <span class="font-bold">Frontend Quiz!</span>
      </h1>
      <p class="italic">Pick a subject to got started</p>
    </div>

    <ul class="flex flex-col gap-4 w-96">
      <li v-for="subject in quiz" :key="subject.id_quiz">
        <NuxtLink class="text-text-primary bg-bg-primary p-4 rounded-lg shadow-md flex flex-row items-center gap-2" :to="`/quiz/${subject.title.replace(' ', '-')}/${subject.quiz_id}`">{{ subject.title }}</NuxtLink>
      </li>
    </ul>
  </div>
</template>

<script setup>
import { fetchQuiz } from "../utils/fetchQuiz.ts";

const quiz = ref(null);

onMounted(async () => {
  try {
    quiz.value = await fetchQuiz();
    console.log(quiz.value);
    
  } catch (error) {
    console.error(error);
  }
});

</script>