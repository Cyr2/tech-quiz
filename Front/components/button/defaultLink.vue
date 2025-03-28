<template>
  <NuxtLink 
    :to="to" 
    class="w-full text-center p-4 rounded-xl cursor-pointer disabled:cursor-default disabled:opacity-75" 
    :class="props.color.bg + ' ' + props.color.text"
    :disabled="disabled || false"
  >
    <slot />
  </NuxtLink>
</template>

<script setup>
const props = defineProps({
  disabled: Boolean,
  to: String,
  color: {
    type: Object,
    default: {
      bg: 'bg-highlight-medium',
      text: 'text-neutral-dark-darkest'
    }
  }
});
</script>