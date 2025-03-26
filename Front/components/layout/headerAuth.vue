<template>
  <header class="flex items-center justify-between px-16 py-8 bg-bg-primary shadow-sm">
    <nav>
      <ul class="flex items-center gap-4">
        <li>
          <NuxtLink to="/login">Login</NuxtLink>
        </li>
        <li>
          <NuxtLink to="/register">Register</NuxtLink>
        </li>
      </ul>
    </nav>
    <ButtonColorMode />
  </header>
</template>