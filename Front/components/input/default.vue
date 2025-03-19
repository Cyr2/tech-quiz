<template>
    <li class="ring-0 ring-inset p-3 shadow-sm rounded-xl bg-bg-primary"  :class="{
        'ring-4 ring-highlight-medium': selectedReponse === reponse.id_reponse && validatedReponse === null,
        'ring-4 ring-support-error-medium': selectedReponse === reponse.id_reponse && validatedReponse === true,
        'ring-4 ring-support-success-medium': selectedReponse === reponse.id_reponse && validatedReponse === false,
        'ring-0': selectedReponse !== reponse.id_reponse
    }">
        <input type="radio" class="invisible" name="reponse" :id="reponse.id_reponse" :value="reponse.id_reponse" @click="updateSelectedReponse(reponse.id_reponse)">
        <label :for="reponse.id_reponse" class="cursor-pointer" >{{ reponse.label }}</label>
    </li>
</template>
// TODO: Fix, la couleur de bordure marche que la première condition.
<script setup>
    const props = defineProps({
        reponse: Object,
        selectedReponse: String,
        updateSelectedReponse: Function
    });

    console.log(props.validatedReponse.value)
</script>