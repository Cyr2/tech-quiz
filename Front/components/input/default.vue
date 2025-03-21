<template>
    <li class="relative ring-4 ring-inset p-3 shadow-sm rounded-xl bg-bg-primary flex items-center justify-between" :class="ringColor">
        <input type="radio" class="opacity-0 absolute w-full h-full top-0 left-0 z-10 cursor-pointer" name="reponse" :id="reponse.id_reponse" :value="reponse.id_reponse" @click="updateSelectedReponse(reponse.id_reponse)">
        <label :for="reponse.id_reponse" class="cursor-pointer" >{{ reponse.label }}</label>
        <div v-if="correctReponse !== reponse.id_reponse && validatedReponse === false && selectedReponse === reponse.id_reponse" class="w-4 h-4 bg-support-error-medium rounded-full" />

        <div v-if="correctReponse === reponse.id_reponse && validatedReponse !== null" class="w-4 h-4 bg-support-success-medium rounded-full" />
    </li>
</template>
<script setup>
import { computed } from 'vue';

const props = defineProps({
    reponse: Object,
    selectedReponse: String,
    updateSelectedReponse: Function,
    validatedReponse: Boolean | null,
    correctReponse: String | null
});

const ringColor = computed(() => {
    console.log(props.selectedReponse, props.reponse.id_reponse, props.validatedReponse);
    
    if (props.selectedReponse === props.reponse.id_reponse && props.validatedReponse === null) {
        return 'ring-4 ring-highlight-medium';
    } else if (props.selectedReponse === props.reponse.id_reponse && props.validatedReponse === true) {
        return 'ring-4 ring-support-success-medium';
    } else if (props.selectedReponse === props.reponse.id_reponse && props.validatedReponse === false) {
        return 'ring-4 ring-support-error-medium';
    }
    return '!ring-0';
});
</script>