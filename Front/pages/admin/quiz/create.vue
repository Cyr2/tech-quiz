<template>
    <section class="bg-white rounded-lg p-10 w-96 flex flex-col gap-4 shadow-xl">
        <article class="flex flex-col gap-2">
            <label for="title">Title</label>
            <input type="text" id="title" name="title" class="border-2 border-solid" v-model="quiz.title" @input="verifQuiz" />
            <p v-if="quiz.errorQuiz"> {{ quiz.errorQuiz }} </p>
        </article>
        <article>
            <ul v-if="quiz.questions.length" class="flex flex-col gap-4">
                <li v-for="(question, index) in quiz.questions" :key="index" class="border-2 border-solid p-4 flex flex-col gap-6">
                    <article class="flex flex-col gap-2">
                        <label for="question">Question</label>
                        <input type="text" id="question" name="question" class="border-2 border-solid" v-model="quiz.questions[index].label" @input="verifQuestion(question)" />
                        <p v-if="quiz.questions[index].errorQuestion"> {{ quiz.questions[index].errorQuestion }} </p> 
                    </article>
                    <ul class="flex flex-col gap-4">
                        <li v-for="(answer, indexAnswer) in quiz.questions[index].answers" :key="indexAnswer" class="border-2 border-solid p-4">
                            <article class="flex flex-col gap-2">
                                <label for="answer">Answer</label>
                                <input type="text" id="answer" name="answer" class="border-2 border-solid" v-model="quiz.questions[index].answers[indexAnswer].label" @input="verifAnswer(answer)" />
                                <p v-if="quiz.questions[index].answers[indexAnswer].errorAnswer"> {{ quiz.questions[index].answers[indexAnswer].errorAnswer }} </p>
                            </article>
                            <article class="flex items-center gap-2">
                                <label for="isCorrect">Is correct</label>
                                <input type="radio" :name="index" id="isCorrect" name="isCorrect" class="border-2 border-solid" v-model="quiz.questions[index].answers[indexAnswer].isCorrect" @click="verifAnswerCorrect(answer)" />
                            </article>
                        </li>
                    </ul> 
                    <ButtonDefaultForm class="mt-2" @click="addAnswer(index)">Ajouter une réponse</ButtonDefaultForm>
                </li>
            </ul>
        </article>
        <ButtonDefaultForm class="mt-2" @click="addQuestion">Ajouter une question</ButtonDefaultForm>
        <ButtonDefaultForm class="mt-2" @click="addQuiz">Créer le quiz</ButtonDefaultForm>
    </section> 
</template>
 
<script setup>

import { fetchCreateQuiz } from '../../../utils/fetchCreateQuiz';

const errorQuiz = ref('');

const quiz = ref({
    title: '',
    questions: [
        {
            label: '',
            answers: [
                { label: '', isCorrect: false, errorAnswer: '' },
                { label: '', isCorrect: false, errorAnswer: '' },
            ],
            errorQuestion: ''
        }
    ],
    errorQuiz: ''
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

const verifQuiz = () => {
    if (quiz.value.title.trim() === '') {
        quiz.value.errorQuiz = 'Le titre ne peut pas être vide';
    } else {
        quiz.value.errorQuiz = '';
    }
}

const verifQuestion = (question) => {
    if (question.label.trim() === '') {
        question.errorQuestion = 'La question ne peut pas être vide';
    } else {
        question.errorQuestion = '';
    }
}

const verifAnswer = (answer) => {
    if (answer.label.trim() === '') {
        answer.errorAnswer = 'La réponse ne peut pas être vide';
    } else {
        answer.errorAnswer = '';
    }
}

const verifAnswerCorrect = (answer) => {
    answer.errorAnswer = '';
}

const addQuiz = async () => {
    if (quiz.value.errorQuiz !== '' || quiz.value.questions.some(question => question.errorQuestion !== '' || question.answers.some(answer => answer.errorAnswer !== ''))) {
        console.log('error');
        return;
    }
    if (quiz.value.title.trim() === '') {
        quiz.value.errorQuiz = 'Le titre ne peut pas être vide';
        return;
    }
    if (quiz.value.questions.some(question => question.label.trim() === '')) {
        quiz.value.questions.forEach(question => {
            if (question.label.trim() === '') {
                question.errorQuestion = 'La question ne peut pas être vide';
            }
        });
        return;
    }
    if (quiz.value.questions.some(question => question.answers.some(answer => answer.label.trim() === ''))) {
        quiz.value.questions.forEach(question => {
            question.answers.forEach(answer => {
                if (answer.label.trim() === '') {
                    answer.errorAnswer = 'La réponse ne peut pas être vide';
                }
            });
        });
        return;
    }
    if (quiz.value.questions.some(question => question.answers.filter(answer => answer.isCorrect).length === 0)) {
        quiz.value.questions.forEach(question => {
            if (question.answers.filter(answer => answer.isCorrect).length === 0) {
                question.answers.forEach(answer => {
                    answer.errorAnswer = 'Il doit y avoir au moins une réponse correcte';
                });
            } 
        });
        return;
    } 

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
    
    if (data.sucess) {
        navigateTo('/');  
    }
}

const addAnswer = (questionIndex) => {
    if (quiz.value.questions[questionIndex].answers.length <= 4) {
        quiz.value.questions[questionIndex].answers.push({ label: '', isCorrect: false });
    }
}
</script>