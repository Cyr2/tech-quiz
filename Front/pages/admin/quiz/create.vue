<template>
    <form action="/" method="post" class="flex flex-col gap-4 w-2/4">
        <div class="flex flex-row justify-between">
            <label for="title" class="font-bold text-yellow-500">Titre</label>
        </div>
        <input type="text" id="title" name="title" class="border-2 border-solid border-solid p-2 rounded-md" placeholder="Ecrire ici">

        <div class="bg-white rounded-lg p-6 shadow-sm flex flex-col gap-8 w-96 border-2 border-solid w-full">
            <div class="flex flex-col gap-2">
                <div class="flex flex-row justify-between">
                    <label for="question" class="font-bold">Question 1</label>
                    <button class="text-red-400" @click.prevent="removeQuestion">Supprimer la question</button>
                </div>
                <input type="text" id="question" name="question" class="border-2 border-solid p-2" placeholder="Ecrire ici">

                <div class="flex flex-row justify-between">
                    <label for="answer">Réponse 1</label>
                    <button class="text-red-400" @click.prevent="removeAnswer">Supprimer la réponse</button>
                </div>
                <div class="flex flex-col items-start gap-2">
                    <input type="text" id="answer" name="answer" class="border-2 border-solid p-2 w-full" placeholder="Ecrire ici">
                    <div class="flex gap-4 mb-4">
                        <input type="radio" name="isCorrect" id="isCorrect">
                        <label for="isCorrect">Réponse correcte</label>
                    </div>
                </div>

                <button class="flex text-gray-400 mt-2" @click.prevent="addAnswer">+ Ajouter une réponse</button>

                <div class="flex flex-row gap-8 justify-between mt-6">
                    <NuxtLink to="/"
                        class="bg-yellow-400 p-6 rounded-lg h-8 w-96 flex items-center justify-center">
                        Annuler
                    </NuxtLink>
                    <button
                        @click.prevent="addQuestion"
                        class="bg-yellow-400 p-6 rounded-lg h-8 w-96 flex items-center justify-center">
                        Ajouter une question
                    </button>
                </div>
            </div>
        </div>

        <button 
            type="submit" 
            class="bg-white border-2 border-solid hover:border-yellow-400 py-2 rounded-lg hover:bg-yellow-400 hover:text-black">
            Enregistrer</button>
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
            { label: '', isCorrect: false },
        ]
    });
}

const addQuiz = async () => {
    const transformedQuiz = {
        ...quiz.value,
        questions: quiz.value.questions.map(question => ({
            ...question,
            answers: question.answers.map(answer => ({
                ...answer,
                isCorrect: answer.isCorrect ? 1 : 0
            }))
        }))
    };
    console.log(transformedQuiz);
    const data = await fetchCreateQuiz(transformedQuiz);
    console.log(data);    
}

const addAnswer = (questionIndex) => {
    if (quiz.value.questions[questionIndex].answers.length <= 4) {
        quiz.value.questions[questionIndex].answers.push({ label: '', isCorrect: false });
    }
}
</script>