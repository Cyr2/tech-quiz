<template>
  <div class="min-h-screen flex flex-col bg-bg-secondary text-text-primary">
    <LayoutHeader />
    <main class="flex-1 flex flex-col items-center px-16 py-8 bg-bg-secondary">
      <slot />
    </main>
  </div>
</template>
<script setup lang="ts">
</script>