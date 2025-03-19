<template>
    <div>
        <h1>register</h1>
        <form @submit.prevent="submit">
            <input type="text" placeholder="email" v-model="email">
            <input type="text" placeholder="verification email" v-model="verificationEmail">
            <input type="password" placeholder="password" v-model="password">
            <button type="submit">Register</button>
            <NuxtLink to="/login">login</NuxtLink>
        </form>
    </div>
</template>

<script setup>
import { fetchRegister } from "../utils/fetchRegister.ts";

const login = ref(null);
const email = ref('');
const verificationEmail = ref('');
const password = ref('');

const submit = async () => {

    if(verificationEmail.value != email.value){
        alert("Emails do not match");
        return;
    }
    try {
        login.value = await fetchRegister(email.value, password.value);
        localStorage.setItem('token', login.value.token);
        localStorage.setItem('user', JSON.stringify(login.value.user));
        
    } catch (error) {
        console.error(error);
    }
}

</script>