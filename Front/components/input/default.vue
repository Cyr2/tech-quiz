<template>
    <li class="ring-0 ring-inset ring-highlight-medium p-3 shadow-sm rounded-xl bg-bg-primary"  :class="selectedReponse === reponse.id_reponse ? 'ring-4' : 'ring-0'">
        <input type="radio" class="hidden" name="reponse" :id="reponse.id_reponse" :value="reponse.id_reponse" @click="updateSelectedReponse(reponse.id_reponse)">
        <label :for="reponse.id_reponse" class="cursor-pointer flex items-center gap-4">
            <span class="w-9 h-9 flex justify-center items-center bg-bg-secondary rounded-md ">{{ letter }}</span>
            <span>{{ reponse.label }}</span>
        </label>
    </li>
</template>

<script setup>
    const props = defineProps({
        reponse: Object,
        selectedReponse: String,
        updateSelectedReponse: Function,
        letter: String
    });
</script>