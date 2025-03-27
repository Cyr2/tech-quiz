<template>
    <form action="/" method="post" class="bg-bg-primary p-6 rounded-lg shadow-lg flex flex-col gap-4 w-2/4">
        <div class="flex flex-row justify-between">
            <label for="title" class="font-bold text-yellow-500">Titre</label>
        </div>
        <input type="text" id="title" name="title" class="border-2 border-solid border-gray-200 p-2 rounded-md" placeholder="Ecrire ici" v-model="quiz.title" @input="verifQuiz">
        <p v-if="errorQuiz">{{ errorQuiz }}</p>

        <div v-for="(question, questionIndex) in quiz.questions" :key="questionIndex" class="rounded-lg p-6 shadow-sm flex flex-col gap-8 w-96 border-2 border-solid border-gray-200 w-full">
            <div class="flex flex-col gap-2">
                <div class="flex flex-row justify-between">
                    <label :for="'question-' + questionIndex" class="font-bold">Question {{ questionIndex + 1 }}</label>
                    <button v-if="quiz.questions.length > 1" class="text-red-400" @click.prevent="removeQuestion(questionIndex)">Supprimer la question</button>
                    <button v-else class="text-red-200" disabled @click.prevent="removeQuestion(questionIndex)">Supprimer la question</button>
                </div>
                <input type="text" :id="'question-' + questionIndex" v-model="question.label" class="border-2 border-solid border-gray-200 p-2 rounded-md" placeholder="Ecrire ici" @input="verifQuestion(questionIndex)">
                <p v-if="errorQuestion">{{ errorQuestion }}</p>

                <hr class="my-4">

                <div v-for="(answer, answerIndex) in question.answers" :key="answerIndex" class="flex flex-col items-start gap-2">
                    <div class="flex flex-row justify-between w-full">
                        <label :for="'answer-' + questionIndex + '-' + answerIndex">Réponse {{ answerIndex + 1 }}</label>
                        <button v-if="quiz.questions[questionIndex].answers.length > 2" class="text-red-400" @click.prevent="removeAnswer(questionIndex, answerIndex)">Supprimer la réponse</button>
                        <button v-else disabled class="text-red-200" @click.prevent="removeAnswer(questionIndex, answerIndex)">Supprimer la réponse</button>
                    </div>
                    <input type="text" :id="'answer-' + questionIndex + '-' + answerIndex" v-model="answer.label" class="border-2 border-solid border-gray-200 p-2 w-full rounded-md" placeholder="Ecrire ici" @input="verifAnswer(questionIndex, answerIndex)">
                    <p v-if="errorAnswer">{{ errorAnswer }}</p>
                    
                    
                    <div class="flex gap-4 mb-4">
                        <label :for="'isCorrect-' + questionIndex + '-' + answerIndex">Réponse correcte</label>
                        <input type="radio" :name="'isCorrect-' + questionIndex" :id="'isCorrect-' + questionIndex + '-' + answerIndex" v-model="question.correctAnswer" :value="answerIndex">
                    </div>
                </div>

                <button v-if="quiz.questions[questionIndex].answers.length < 4" class="flex text-gray-400 mt-2" @click.prevent="addAnswer(questionIndex)">+ Ajouter une réponse</button>
            </div>
        </div>

        <div class="flex flex-row gap-8 justify-between mt-6">
            <NuxtLink to="/"
                class="bg-yellow-400 p-6 rounded-lg h-8 w-96 flex items-center justify-center">
                Annuler
            </NuxtLink>

            <button
                v-if="quiz.questions.length < 10"
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

const errorQuiz = ref('');
const errorQuestion = ref('');
const errorAnswer = ref('');

const quiz = ref({
    title: '',
    questions: [
        {
            label: '',
            correctAnswer: null, // Stocke l'index de la réponse correcte
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
};

const addAnswer = (questionIndex) => {
    quiz.value.questions[questionIndex].answers.push({ label: '', isCorrect: false });
};

const removeQuestion = (questionIndex) => {
    if (quiz.value.questions.length > 1) {
        quiz.value.questions.splice(questionIndex, 1);
    }
};

const removeAnswer = (questionIndex, answerIndex) => {
    quiz.value.questions[questionIndex].answers.splice(answerIndex, 1);
};

const saveQuiz = () => {
    if (quiz.value.title.trim() === '') {
        errorQuiz.value = 'Le titre ne peut pas être vide';
        return;
    } else {
        errorQuiz.value = '';
    }

    if (quiz.value.questions.length === 0) {
        errorQuestion.value = 'Il doit y avoir au moins une question';
        return;
    } else {
        errorQuestion.value = '';
    }

    for (let i = 0; i < quiz.value.questions.length; i++) {
        const question = quiz.value.questions[i];
        if (question.label.trim() === '') {
            errorQuestion.value = `La question ${i + 1} ne peut pas être vide`;
            return;
        }

        if (question.answers.length === 0) {
            errorAnswer.value = `La question ${i + 1} doit avoir au moins une réponse`;
            return;
        }

        if (question.correctAnswer === null) {
            errorAnswer.value = `La question ${i + 1} doit avoir une réponse correcte sélectionnée`;
            return;
        }

        for (let j = 0; j < question.answers.length; j++) {
            if (question.answers[j].label.trim() === '') {
                errorAnswer.value = `Toutes les réponses de la question ${i + 1} doivent être remplies`;
                return;
            }
        }
    }

    const preparedQuiz = {
        title: quiz.value.title,
        questions: quiz.value.questions.map((question) => {
            return {
                label: question.label,
                answers: question.answers.map((answer, index) => {
                    return {
                        label: answer.label,
                        isCorrect: index === question.correctAnswer ? 1 : 0, // Marque la réponse correcte avec 1 ou 0
                    };
                }),
            };
        }),
    };

    console.log(preparedQuiz);
    fetchCreateQuiz(preparedQuiz);
    navigateTo('/');
    
};

const verifQuiz = () => {
    if(quiz.value.title.trim() === '') {
        errorQuiz.value = 'Le titre ne peut pas être vide';
        return;
    }
    errorQuiz.value = '';
}

const verifQuestion = (questionIndex) => {
    if(quiz.value.questions[questionIndex].label.trim() === '') {
        errorQuestion.value = 'La question ne peut pas être vide';
        return;
    }
    errorQuestion.value = '';
}

const verifAnswer = (questionIndex, answerIndex) => {
    if(quiz.value.questions[questionIndex].answers[answerIndex].label.trim() === '') {
        errorAnswer.value = 'La réponse ne peut pas être vide';
        return;
    }
    errorAnswer.value = '';
}
</script>