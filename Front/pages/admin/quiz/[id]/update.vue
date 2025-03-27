<template>
    <form action="/" method="post" class="flex flex-col gap-4 w-3xl" @submit.prevent="submit">
        <div class="flex flex-row justify-between">
            <label for="title" class="font-bold text-yellow-500">Titre</label>
        </div>
        <input type="text" id="title" name="title" class="border-2 border-solid border-solid p-2 rounded-md" v-model="tab.title">

        <div class="bg-white rounded-lg p-6 shadow-sm flex flex-col gap-8 w-96 border-2 border-solid w-full">
            <div class="flex flex-col gap-2">
                <div class="flex flex-row justify-between">
                    <label for="question" class="font-bold">Question {{ currentQuestion + 1 }}</label>
                    <button class="text-red-400" @click.prevent="removeQuestion(currentQuestion)">Supprimer la question</button>
                </div>
                <input type="text" id="question" name="question" class="border-2 border-solid p-2" v-model="tab.questions[currentQuestion].label">

                <div v-for="(answer, index) in tab.questions[currentQuestion].answers" :key="index" class="flex flex-col gap-2">
                    <div class="flex flex-row justify-between">
                        <label :for="'answer' + index">Réponse {{ index + 1 }}</label>
                        <button class="text-red-400" @click.prevent="removeAnswer(currentQuestion, index)">Supprimer la réponse</button>
                    </div>
                    <div class="flex flex-col items-start gap-2">
                        <input type="text" :id="'answer' + index" :name="'answer' + index" class="border-2 border-solid p-2 w-full" v-model="answer.label">
                        <div class="flex gap-4 mb-4" v-if="answer.isCorrect">
                            <label :for="'isCorrect' + index">Réponse correcte</label>
                            <input type="radio" name="isCorrect" :id="'isCorrect' + index" checked v-model="answer.isCorrect">
                        </div>
                        <div class="flex gap-4 mb-4" v-else>
                            <label :for="'isCorrect' + index">Réponse correcte</label>
                            <input type="radio" name="isCorrect" :id="'isCorrect' + index" v-model="answer.isCorrect">
                        </div>
                    </div>
                </div>

                <button class="flex text-gray-400 mt-2" @click.prevent="addAnswer(currentQuestion)">+ Ajouter une réponse</button>

                <div class="flex flex-row gap-8 justify-between mt-6">
                    <button 
                        v-if="currentQuestion === 0"
                        @click.prevent="prevQuestion" 
                        class="bg-gray-200 p-6 rounded-lg h-8 w-96 flex items-center justify-center"
                        disabled="true">
                        Precedent
                    </button>
                    <button 
                        v-else
                        @click.prevent="prevQuestion" 
                        class="bg-yellow-400 p-6 rounded-lg h-8 w-96 flex items-center justify-center">
                        Precedent
                    </button>

                    <button
                        v-if="!LastQuestion" 
                        @click.prevent="nextQuestion" 
                        class="bg-yellow-400 p-6 rounded-lg h-8 w-96 flex items-center justify-center">
                        Suivant
                    </button>
                    <button 
                        v-else
                        @click.prevent="addQuestion"
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

import { ref, computed, onMounted } from 'vue';
import { useRoute } from 'vue-router';
import { fetchQuizById } from '../../../../utils/fetchQuizById';
import { fetchQuestionsByIdQuiz } from '../../../../utils/fetchQuestionsByIdQuiz';
import { fetchAnswersByIdQuestion } from '../../../../utils/fectAnswersByIdQuestion';
import { fetchUpdateQuiz } from '../../../../utils/fetchUpdateQuiz';

const route = useRoute();

const id = computed(() => route.params.id);


const tab = ref({
    title: 'Nouveau quiz',
    questions: [
        {
            questionId : '',
            label: 'question ?',
            answers: [
                { label: '', isCorrect: false, answerId : ''},
                { label: '', isCorrect: false, answerId : ''},
            ],
        }
    ],
});

const currentQuestion = ref(0);

const LastQuestion = computed(() => currentQuestion.value === tab.value.questions.length - 1);

const nextQuestion = () => {
    if (currentQuestion.value < tab.value.questions.length - 1) {
        currentQuestion.value++;
    }
};

const prevQuestion = () => {
    if (currentQuestion.value > 0) {
        currentQuestion.value--;
    }
};

const addQuestion = () => {
    tab.value.questions.push({
        questionId : '',
        label: 'Nouvelle question ?',
        answers: [
            { label: '', isCorrect: false, answerId : ''},
            { label: '', isCorrect: false, answerId : ''},
        ],
    });
    currentQuestion.value = tab.value.questions.length - 1;
};

const removeQuestion = (index) => {
    if (tab.value.questions.length > 1) {
        tab.value.questions.splice(index, 1);
        currentQuestion.value = Math.max(0, currentQuestion.value - 1);
    }
};

const addAnswer = (questionIndex) => {
    if(tab.value.questions[questionIndex].answers.length >= 4) return;
    tab.value.questions[questionIndex].answers.push({ label: '', isCorrect: false, answerId : '' });
};
 
const removeAnswer = (questionIndex, answerIndex) => {
    if (tab.value.questions[questionIndex].answers.length > 2) {
        tab.value.questions[questionIndex].answers.splice(answerIndex, 1);
    } 
};

const submit = async () => {
    if(tab.value.title === '') return;
    if(tab.value.questions.length === 0) return;
    if(tab.value.questions.some(question => question.label === '')) return;
    if(tab.value.questions.some(question => question.answers.some(answer => answer.label === ''))) return;

    const transformedQuiz = {
        ...tab.value,
        questions: tab.value.questions.map(question => ({
            ...question,
            answers: question.answers.map((answer, _, answers) => {
                if (answer.isCorrect) {
                    // If 'on' is found, set all others to 0 and this one to 1
                    answers.forEach(a => a.isCorrect = 0);
                    answer.isCorrect = 1;
                } else if (!answers.some(a => a.isCorrect)) {
                    // If no 'on' exists, keep the existing 1
                    const existingCorrect = answers.find(a => a.isCorrect === 1);
                    if (existingCorrect) {
                        existingCorrect.isCorrect = 1;
                    }
                }
                return {
                    ...answer,
                    isCorrect: answer.isCorrect ? 1 : 0
                };
            })
        }))
    };

    const date = new Date();
    const formattedDate = date.toISOString().split('T')[0];
    console.log(transformedQuiz);
    const data = await fetchUpdateQuiz(id.value, transformedQuiz, formattedDate);
    console.log(data);
    
};

onMounted(async () => {

        const quizData = await fetchQuizById(id.value);
        if(quizData){
            tab.value.title = quizData.title;
        }
 
        const questionsData = await fetchQuestionsByIdQuiz(id.value);
        if(questionsData){
            for (let i = 0; i < questionsData.length; i++) {
                    if(!tab.value.questions[i]){
                        tab.value.questions.push({
                            questionId : '',
                            label: 'Nouvelle question ?',
                            answers: [
                                { label: '', isCorrect: false, answerId : ''},
                                { label: '', isCorrect: false, answerId : ''},
                            ],
                        });
                    }
                    tab.value.questions[i].questionId = questionsData[i].question_id;
                    tab.value.questions[i].label = questionsData[i].label;


                const answersData = await fetchAnswersByIdQuestion(questionsData[i].question_id);
                if(answersData){
                    for (let j = 0; j < answersData.length; j++) {
                        if(!tab.value.questions[i].answers[j]){
                            tab.value.questions[i].answers.push({ label: '', isCorrect: false, answerId : '' });
                        }
                        tab.value.questions[i].answers[j].answerId = answersData[j].answer_id;
                        tab.value.questions[i].answers[j].label = answersData[j].label;
                        tab.value.questions[i].answers[j].isCorrect = answersData[j].is_correct;
                    }
                }
            }
        }
});
</script>