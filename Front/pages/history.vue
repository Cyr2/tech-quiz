<template>
  <div class="h-full w-2/3 flex flex-col gap-16 justify-between">
    <genericDefaultTable :data="history" />
  </div>
</template>

<script setup>
import { useAuth } from '~/stores/auth';
import { fetchHistoryByUser } from '../utils/fetchHistoryByUser';
import { fetchQuiz } from '../utils/fetchQuiz';

const auth = useAuth();

const user_id = ref(null);
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
  user_id.value = auth.getUserId();
});

watch(user_id, async () => {
  try {
    const response = await fetchHistoryByUser(user_id.value);
    
    history.value = await filterData(response);
  } catch (err) {
    console.error('Error fetching data:', err);
    error.value = err.message || 'An unexpected error occurred.';
    history.value = [];
  }
});
</script>