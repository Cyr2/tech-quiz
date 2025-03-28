<template>
  <div class="h-full w-2/3 flex flex-col gap-16 justify-between">

    <genericDefaultTable v-if="!error" :data="history" />
    <p v-else>{{ error }}</p>
  </div>
</template>

<script setup>
import { onMounted } from 'vue';
import { fetchHistoryByUser } from '../../../../utils/fetchHistoryByUser';
import { fetchQuiz } from '../../../../utils/fetchQuiz';

const route = useRoute();
const user_id = computed(() => route.params.id);

const history = ref([]);
const error = ref(null);

const filterData = async (data) => {
  const results = await Promise.all(
    data.map(async (item) => {
      const quiz = await fetchQuiz(item.quiz_id);
      return {
        id: item.history_id,
        date: new Date(item.date).toLocaleDateString('fr-FR', {
          day: '2-digit',
          month: 'long',
          year: 'numeric',
        }),
        quiz: quiz.title,
        score: item.score,
      };
    })
  );
  return results;
};


onMounted(async () => {
  try {
    const response = await fetchHistoryByUser(user_id.value);
    
    console.log(response, user_id.value);
    if(response.length === 0) {
      error.value = 'Aucun historique trouvé.';
      return;
    }
    
    history.value = await filterData(response);
  } catch (err) {
    console.error('Error fetching data:', err);
    error.value = err.message || 'An unexpected error occurred.';
    history.value = [];
  }
});
</script>