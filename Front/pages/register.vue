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
        <p v-if="errorMessage">{{ errorMessage }}</p>
    </div>
</template>

<script setup>

import { useAuth } from "../stores/auth.js";
import { fetchRegister } from "../utils/fetchRegister.ts";

const user = useAuth();

const register = ref(null);
const email = ref('');
const verificationEmail = ref('');
const password = ref('');
const errorMessage = ref('');

const submit = async () => {

    if(!email.value || !password.value){
        errorMessage.value = 'remplissez tous les champs';
        return;
    }

    if(email.value !== verificationEmail.value){
        errorMessage.value = 'les emails ne correspondent pas';
        return;
    }

        


        register.value = await fetchRegister(email.value, password.value);
        if(register.value.error){
            errorMessage.value = register.value.error;
            return;
        }
        else{
            errorMessage.value = '';
        }
    
        user.insertToken(register.value.token);
        user.initializeUser(register.value.user.id, register.value.user.email);  

    
}

</script>