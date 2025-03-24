<template>
    <h1>Update</h1>
</template>

<script setup>
import { useRoute } from 'vue-router';

const route = useRoute();

const quizId = route.params.id;
</script>