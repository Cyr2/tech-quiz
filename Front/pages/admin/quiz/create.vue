<template>
    <section class="bg-white rounded-lg p-10 w-96 flex flex-col gap-4 shadow-xl">
        <article class="flex flex-col gap-2">
            <label for="title">Title</label>
            <input type="text" id="title" name="title" class="border-2 border-solid" v-model="quiz.title" />
        </article>
        <article>
            <ul v-if="quiz.questions.length" class="flex flex-col gap-4">
                <li v-for="(question, index) in quiz.questions" :key="index" class="border-2 border-solid p-4 flex flex-col gap-6">
                    <article class="flex flex-col gap-2">
                        <label for="question">Question</label>
                        <input type="text" id="question" name="question" class="border-2 border-solid" v-model="quiz.questions[index].label" />
                    </article>
                    <ul class="flex flex-col gap-4">
                        <li v-for="(answer, indexAnswer) in quiz.questions[index].answers" :key="indexAnswer" class="border-2 border-solid p-4">
                            <article class="flex flex-col gap-2">
                                <label for="answer">Answer</label>
                                <input type="text" id="answer" name="answer" class="border-2 border-solid" v-model="quiz.questions[index].answers[indexAnswer].label" />
                            </article>
                            <article class="flex items-center gap-2">
                                <label for="isCorrect">Is correct</label>
                                <input type="radio" :name="index" id="isCorrect" name="isCorrect" class="border-2 border-solid" v-model="quiz.questions[index].answers[indexAnswer].isCorrect" />
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

const addQuiz = () => {
    console.log(quiz.value);
}

const addAnswer = (questionIndex) => {
    if (quiz.value.questions[questionIndex].answers.length <= 4) {
        quiz.value.questions[questionIndex].answers.push({ label: '', isCorrect: false });
    }
}
</script>