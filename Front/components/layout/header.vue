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
          <NuxtLink to="/Logout">Logout</NuxtLink>
        </li>
      </ul>
    </nav>
    <ButtonColorMode />
  </header>
</template>