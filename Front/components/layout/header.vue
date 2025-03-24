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
        <li v-if="isAdmin">
          <NuxtLink to="/admin">Admin</NuxtLink>
        </li>
        <li v-if="isLoggedIn">
          <button @click="logout">Logout</button>
        </li>
        <li v-if="!isLoggedIn">
          <NuxtLink to="/login">Login</NuxtLink>
        </li>
        <li v-if="!isLoggedIn">
          <NuxtLink to="/register">Register</NuxtLink>
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

const isLoggedIn = computed(() => !!auth.getToken());
const isAdmin = computed(() => auth.getRole() === '1');

console.log(isAdmin.value, auth.getRole());



const logout = () => {
  auth.removeToken();
};
</script>
