<template>
  <button 
    class="w-full text-center p-4 rounded-xl cursor-pointer disabled:cursor-default disabled:opacity-75" 
    :class="props.color.bg + ' ' + props.color.text"
    :disabled="disabled" 
    @click="clickAction">
    <slot />
  </button>
</template>

<script setup>
const props = defineProps({
  disabled: Boolean,
  click: Function,
  prevent: {
    type: Boolean,
    default: false
  },
  color: {
    type: Object,
    default: {
      bg: 'bg-highlight-medium',
      text: 'text-neutral-dark-darkest'
    }
  }
});

const clickAction = (event) => {
  if (props.prevent) {
    event.preventDefault();
    props.click(event)
  } else {
    props.click(event);
  }
};
</script>