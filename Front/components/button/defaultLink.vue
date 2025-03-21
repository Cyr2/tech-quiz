<template>
  <NuxtLink :to="to" class="w-full text-center bg-highlight-medium p-4 rounded-xl cursor-pointer disabled:cursor-default disabled:opacity-75 text-neutral-dark-darkest" :disabled="disabled || false">
    <slot />
  </NuxtLink>
</template>

<script setup>
const props = defineProps({
  disabled: Boolean,
  to: String
});
</script>