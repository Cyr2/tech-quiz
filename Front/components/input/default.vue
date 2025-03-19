<template>
    <li
    class="border-2 rounded-lg"
    :class="{
        'border-[#A729F5]': selectedReponse === reponse.id_reponse && validatedReponse === null,
        'border-support-error-medium': selectedReponse === reponse.id_reponse && validatedReponse === true,
        'border-support-success-medium': selectedReponse === reponse.id_reponse && validatedReponse === false,
        'border-none': selectedReponse !== reponse.id_reponse
    }"
    >
        <input type="radio" class="invisible" name="reponse" :id="reponse.id_reponse" :value="reponse.id_reponse" @click="updateSelectedReponse(reponse.id_reponse)">
        <label :for="reponse.id_reponse" class="cursor-pointer" >{{ reponse.label }}</label>
    </li>
</template>
// TODO: Fix la couleur de bordure marche que la première condition
<script setup>
    const props = defineProps({
        reponse: Object,
        selectedReponse: String,
        updateSelectedReponse: Function,
        validatedReponse: Boolean | null
    });

    console.log(props.validatedReponse.value)
</script>