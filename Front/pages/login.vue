<template>
    <div>
        <h1>login</h1>
        <form @submit.prevent="submit">
            <input type="text" placeholder="email" v-model="email">
            <input type="password" placeholder="password" v-model="password">
            <button type="submit">Login</button>
            <NuxtLink to="/register">Register</NuxtLink>
        </form>
    </div>
</template>

<script setup>
import { fetchLogin } from "../utils/fetchLogin.ts";

localStorage.clear();

const login = ref(null);
const email = ref('');
const password = ref('');

const submit = async () => {
    try {
        login.value = await fetchLogin(email.value, password.value);
        localStorage.setItem('token', login.value.token);
        localStorage.setItem('user', JSON.stringify(login.value.user));
        console.log(localStorage.getItem('token'));
        console.log(localStorage.getItem('user'));
        
    } catch (error) {
        console.error(error);
    }
}

</script>