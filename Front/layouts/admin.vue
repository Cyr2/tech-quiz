<template>
  <div class="min-h-screen h-screen flex flex-col bg-bg-secondary text-text-primary">
    <LayoutHeader />
    <div class="flex flex-1">
      <ul class="flex flex-col gap-16 justify-center bg-bg-primary p-4 border-r-2 border-bg-secondary">
        <li>
          <ButtonDefaultLink to="/admin/quiz" class="!w-full">Quiz</ButtonDefaultLink>
        </li>
        <li>
          <ButtonDefaultLink to="/admin/users" class="!w-full">Users</ButtonDefaultLink>
        </li>
      </ul>
      <main class="flex-1 flex flex-col py-8 px-8 max-w-full overflow-auto bg-bg-secondary">
        <slot />
      </main>
    </div>
  </div>
</template>
<script setup lang="ts">
</script>