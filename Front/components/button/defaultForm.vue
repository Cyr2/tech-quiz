<template>
  <button class="w-full bg-highlight-medium p-4 rounded-xl cursor-pointer disabled:cursor-default disabled:opacity-75 text-neutral-dark-darkest" :disabled="disabled" @click="click">
    <slot />
  </button>
</template>

<script setup>
const props = defineProps({
  disabled: Boolean,
  click: Function
});
</script>