<template>
    <form action="/" method="post" class="bg-bg-primary p-6 rounded-lg shadow-lg flex flex-col gap-4 w-2/4">
        <div class="flex flex-row justify-between">
            <label for="title" class="font-bold text-yellow-500">Titre</label>
        </div>
        <input type="text" id="title" name="title" class="border-2 border-solid border-gray-200 p-2 rounded-md" placeholder="Ecrire ici">

        <div v-for="(question, questionIndex) in quiz.questions" :key="questionIndex" class="rounded-lg p-6 shadow-sm flex flex-col gap-8 w-96 border-2 border-solid border-gray-200 w-full">
            <div class="flex flex-col gap-2">
                <div class="flex flex-row justify-between">
                    <label :for="'question-' + questionIndex" class="font-bold">Question {{ questionIndex + 1 }}</label>
                    <button class="text-red-400" @click.prevent="removeQuestion(questionIndex)">Supprimer la question</button>
                </div>
                <input type="text" :id="'question-' + questionIndex" v-model="question.label" class="border-2 border-solid border-gray-200 p-2 rounded-md" placeholder="Ecrire ici">

                <div v-for="(answer, answerIndex) in question.answers" :key="answerIndex" class="flex flex-col items-start gap-2">
                    <div class="flex flex-row justify-between w-full">
                        <label :for="'answer-' + questionIndex + '-' + answerIndex">Réponse {{ answerIndex + 1 }}</label>
                        <button class="text-red-400" @click.prevent="removeAnswer(questionIndex, answerIndex)">Supprimer la réponse</button>
                    </div>
                    <input type="text" :id="'answer-' + questionIndex + '-' + answerIndex" v-model="answer.label" class="border-2 border-solid border-gray-200 p-2 w-full rounded-md" placeholder="Ecrire ici">
                    <div class="flex gap-4 mb-4">
                        <input type="radio" :name="'isCorrect' + questionIndex" :id="'isCorrect' + questionIndex">
                        <label for="isCorrect">Réponse correcte</label>
                    </div>
                </div>

                <button class="flex text-gray-400 mt-2" @click.prevent="addAnswer(questionIndex)">+ Ajouter une réponse</button>
            </div>
        </div>

        <div class="flex flex-row gap-8 justify-between mt-6">
            <NuxtLink to="/"
                class="bg-yellow-400 p-6 rounded-lg h-8 w-96 flex items-center justify-center">
                Annuler
            </NuxtLink>

            <button
                v-if="quiz.questions.length < 4"
                @click.prevent="addQuestion"
                class="bg-yellow-400 p-6 rounded-lg h-8 w-96 flex items-center justify-center">
                Ajouter une question
            </button>
            <button
                v-else
                disabled
                @click.prevent="addQuestion"
                class="bg-gray-300 text-gray-500 p-6 rounded-lg h-8 w-96 flex items-center justify-center cursor-not-allowed">
                Ajouter une question
            </button>
        </div>

        <button 
            type="submit" 
            class="border-2 border-solid border-gray-200 hover:border-yellow-400 py-2 rounded-lg hover:bg-yellow-400"
            @click.prevent="saveQuiz">
            Enregistrer
        </button>
    </form>
</template>

<script setup>
import { fetchCreateQuiz } from '../../../utils/fetchCreateQuiz';

const quiz = ref({
    title: '',
    questions: [
        {
            label: '',
            answers: [
                { label: '', isCorrect: false },
            ]
        }
    ]
});

const addQuestion = () => {
    quiz.value.questions.push({
        label: '',
        answers: [
            { label: '', isCorrect: false },
        ]
    }); 
};

const addAnswer = (questionIndex) => {
    if (quiz.value.questions[questionIndex].answers.length < 4) {
        quiz.value.questions[questionIndex].answers.push({ label: '', isCorrect: false });
    }
};

const removeQuestion = (questionIndex) => {
    quiz.value.questions.splice(questionIndex, 1);
};

const removeAnswer = (questionIndex, answerIndex) => {
    if (quiz.value.questions[questionIndex].answers.length > 1) {
        quiz.value.questions[questionIndex].answers.splice(answerIndex, 1);
    }
};

const saveQuiz = () => {
    alert('Quiz enregistré');
}
</script>