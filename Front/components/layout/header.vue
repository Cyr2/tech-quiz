<template>
  <header class="flex items-center justify-between px-16 py-8 bg-bg-primary shadow-sm">
    <nav>
      <ul class="flex items-center gap-4">
        <li>
          <NuxtLink to="/">Home</NuxtLink>
        </li>
        <li>
          <NuxtLink to="/history">History</NuxtLink>
        </li>
        <li>
          <NuxtLink to="/admin">Admin</NuxtLink>
          <!-- TODO: Faire la logique de vérif -->
        </li>
        <li>
          <button @click="logout">Logout</button>
        </li>
      </ul>
    </nav>
    <ButtonColorMode />
  </header>
</template>

<script setup>
import { useAuth } from '~/stores/auth';
import { computed } from 'vue';

const auth = useAuth();

const isAdmin = computed(() => auth.getRole() === '1');

const logout = () => {
  auth.removeToken();
  auth.removeUserId();
  navigateTo('/login');
};
</script>
