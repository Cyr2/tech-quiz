<template>
    <div class="flex flex-col justify-center items-center">
        <div class="flex flex-col justify-between items-center bg-bg-primary p-14 rounded-2xl shadow-md gap-4">
            <hgroup class="flex flex-col items-center gap-2">     
                <h1 class="font-medium text-2xl text-text-primary">Create to Account</h1>
                <p class="text-sm text-text-secondary">Create a account to continue</p>
            </hgroup>
            <form @submit.prevent="submit" class="flex flex-col justify-between items-center w-full gap-4">
                <div class="flex flex-col w-full gap-2">
                    <label for="email" class="text-text-primary">Email address:</label>
                    <input type="text" placeholder="esteban_schiller@gmail.com" v-model="email" required class="rounded-lg bg-bg-secondary p-3 border-2" id="email">
                </div>
                <div class="flex flex-col w-full gap-2">
                    <label for="username" class="text-text-primary">Username</label>
                    <input type="text" placeholder="username" v-model="username" required class="rounded-lg bg-bg-secondary p-3 border-2" id="username">
                </div>
                <div class="flex flex-col w-full gap-2">
                    <label for="passord" class="text-text-primary">Password</label>
                    <div class="flex items-center gap-2">
                        <input type="password" placeholder="password" v-model="password" required @input="error" id="password" class="rounded-lg bg-bg-secondary p-3 border-2 w-10/12">
                        <button @click="viewPassword" type="button" class="bg-highlight-medium text-neutral-light-medium px-4 py-3 text-base rounded-lg "><img src="../public/assets/yeux.png" alt="yeux" class="w-9"></button>
                    </div>
                    <p v-if="errorPassword" class="text-support-error-medium">{{ errorPassword }}</p>
                </div>
                <input type="submit" value="Sign in" class="bg-highlight-medium text-neutral-dark-dark px-4 py-2 w-full mt-4 text-base rounded-lg">
                <p v-if="errorMessage" class="text-support-error-medium">{{ errorMessage }}</p>
            </form>
            <p class="flex gap-1 text-text-primary">Already have an account?<NuxtLink to="/login" class="text-highlight-medium underline decoration-solid">Login</NuxtLink></p>
        </div>
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

    register.value = await fetchRegister(email.value, password.value, username.value);
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