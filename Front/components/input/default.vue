<template>
    <li class="relative ring-4 ring-inset p-3 shadow-sm rounded-xl bg-bg-primary flex items-center justify-between" :class="ringColor">
        <input type="radio" class="opacity-0 absolute w-full h-full top-0 left-0 z-10 cursor-pointer" name="reponse" :id="reponse.answer_id" :value="reponse.answer_id" @click="updateSelectedReponse(reponse.answer_id)">
        <label :for="reponse.answer_id" class="cursor-pointer" >{{ reponse.label }}</label>
        <div v-if="correctReponse !== reponse.answer_id && validatedReponse === false && selectedReponse === reponse.answer_id" class="w-4 h-4 bg-support-error-medium rounded-full" />

        <div v-if="correctReponse === reponse.answer_id && validatedReponse !== null" class="w-4 h-4 bg-support-success-medium rounded-full" />
    </li>
</template>
<script setup>
import { computed } from 'vue';

const props = defineProps({
    reponse: Object,
    selectedReponse: Number,
    updateSelectedReponse: Function,
    validatedReponse: Boolean | null,
    correctReponse: String | null
});

const ringColor = computed(() => {
    if (props.selectedReponse === props.reponse.answer_id && props.validatedReponse === null) {
        return 'ring-4 ring-highlight-medium';
    } else if (props.selectedReponse === props.reponse.answer_id && props.validatedReponse) {
        return 'ring-4 ring-support-success-medium';
    } else if (props.selectedReponse === props.reponse.answer_id && props.validatedReponse === false) {
        return 'ring-4 ring-support-error-medium';
    }
    return '!ring-0';
});
</script>