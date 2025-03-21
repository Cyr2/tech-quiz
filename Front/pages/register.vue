<template>
    <div>
        <h1>register</h1>
        <form @submit.prevent="submit">
            <input type="email" placeholder="email" v-model="email">
            <input type="text" placeholder="username" v-model="username">
            <input type="password" placeholder="password" v-model="password" @input="error" id="password">
            <button @click="viewPassword" type="button">visualiser password</button>
            <p v-if="errorPassword">{{ errorPassword }}</p>
            <input type="submit" value="register">
            <NuxtLink to="/login">login</NuxtLink>
        </form>
        <p v-if="errorMessage">{{ errorMessage }}</p>
    </div>
</template>

<script setup>

import { useAuth } from "../stores/auth.js";
import { fetchRegister } from "../utils/fetchRegister.ts";

const user = useAuth();

const register = ref(null);
const email = ref('');
const username = ref('');
const password = ref('');
const errorMessage = ref('');
const errorPassword = ref('');

const viewPassword = () => {
    const input = document.querySelector('#password');
    if(input.type === 'password'){
        input.type = 'text';
    }else{
        input.type = 'password';
    }
};

const error = () => {

    const hasUpperCase = /[A-Z]/.test(password.value);
    const hasLowerCase = /[a-z]/.test(password.value);
    const hasNumber = /[0-9]/.test(password.value);
    const hasSpecialChar = /[!@#$%^&*(),.?":{}|<>[\]\\\/'`~\-_=+;<>]/.test(password.value);
    
    if(password.value.length <= 7){
        errorPassword.value = 'le mot de passe doit contenir au moins 8 caractères';
        return;
    }
    else if (!hasUpperCase) {
        errorPassword.value = 'le mot de passe doit contenir au moins une lettre majuscule';
        return;
    }
    else if (!hasLowerCase) {
        errorPassword.value = 'le mot de passe doit contenir au moins une lettre minuscule';
        return;
    }
    else if (!hasNumber) {
        errorPassword.value = 'le mot de passe doit contenir au moins un chiffre';
        return;
    }
    else if (!hasSpecialChar) {
        errorPassword.value = 'le mot de passe doit contenir au moins un caractère spécial';
        return;
    }
    else{
        errorPassword.value = '';
    }

};

const submit = async () => {

    if(errorPassword.value){
        return;
    }

    if(!email.value || !password.value || !username.value){
        errorMessage.value = 'remplissez tous les champs';
        return;
    }

    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/i;
        if (!emailPattern.test(email.value.trim())) {
            errorMessage.value = 'Veuillez entrer une adresse email valide';
            return;
        }

    register.value = await fetchRegister(email.value, password.value);
    if (register.value.error) {
        errorMessage.value = register.value.error;
        return;
    } else {
        errorMessage.value = '';
    }

    user.insertToken(register.value.token);
    user.initializeUser(register.value.user.id, register.value.user.email);

    navigateTo('/');

};

</script>