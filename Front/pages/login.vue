<template>
    <div>
        <h1>login</h1>
        <form @submit.prevent="submit">
            <input type="text" placeholder="email" v-model="email" required>
            <input type="password" placeholder="password" v-model="password" required>
            <button type="submit">Login</button>
            <NuxtLink to="/register">Register</NuxtLink>
        </form>
        <p v-if="errorMessage">{{ errorMessage }}</p>
    </div>
</template>

<script setup>


import { fetchLogin } from "../utils/fetchLogin.ts";
import { useAuth } from "../stores/auth.js";

const user = useAuth();

const login = ref(null);
const email = ref('');
const password = ref('');
const errorMessage = ref('');

const submit = async () => {

        if(!email.value || !password.value){
            errorMessage.value = 'remplissez tous les champs';
            return;
        }

        login.value = await fetchLogin(email.value, password.value);
        if(login.value.error){
            errorMessage.value = login.value.error;
            return;
        }
        else{
            errorMessage.value = '';
        }
    
        user.insertToken(login.value.token);
        user.initializeUser(login.value.user.id, login.value.user.email);  

    
}

</script>

