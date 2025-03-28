<template>
  <div class="h-full w-2/3 flex flex-col gap-8">
    <div class="flex flex-col w-full gap-8 items-end">
      <h1 class="text-3xl font-bold flex w-full justify-start">Quiz List</h1>
      <ButtonDefaultLink class="!w-fit" to="/admin/quiz/create">Nouveau Quiz</ButtonDefaultLink>
    </div>
    <div class="h-full w-full flex items-center justify-center">
      <genericDefaultTable v-if="!error" :data="quiz" :action="action" />
      <p v-else>{{ error }}</p>
    </div>
  </div>
</template>

<script setup>
import { onMounted } from 'vue';
import { fetchAllQuiz } from '../../../../utils/fetchAllQuiz';
import { fetchDeleteQuiz } from '../../../../utils/fetchDeleteQuiz';


const quiz = ref([]);
const error = ref(null);

const action = [
{
  name: 'Update',
  redirection: '/admin/quiz/:id/update',
  colors: {
    bg: 'bg-highlight-medium',
    text: 'text-text-primary'
  },
  disabled: false
}, {
  name: 'Delete',
  click: (item) => {
    deleteQuiz(item);
  },
  colors: {
    bg: 'bg-support-warning-medium',
    text: 'text-bg-primary'
  },
  disabled: false
},
];

const deleteQuiz = async (id) => {
  const confirmation = confirm('Êtes-vous sûr de vouloir supprimer ce quiz ?');
  if (!confirmation) return;

  try {
    const response = await fetchDeleteQuiz(id);
      quiz.value = quiz.value.filter(item => item.id !== id);
  } catch (err) {
    console.error('Error deleting quiz:', err);
    error.value = err.message || 'An unexpected error occurred.';
  }
};

const filterData = async (data) => {
  return data.map((item => {
    return {
      id: item.quiz_id,
      name: item.title,
      'creation date': new Date(item.date).toLocaleDateString('fr-FR', {
        day: '2-digit',
        month: 'long',
        year: 'numeric',
      }),
    };
  }));
};


onMounted(async () => {
  try {
    const response = await fetchAllQuiz();
  
    if(response.length === 0) {
      error.value = 'Aucun quiz trouvé.';
      return;
    }
    
    quiz.value = await filterData(response);
  } catch (err) {
    console.error('Error fetching data:', err);
    error.value = err.message || 'An unexpected error occurred.';
    quiz.value = [];
  }
});
</script>