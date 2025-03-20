<template>
    <div>
        <h1>login</h1>
        <form @submit.prevent="submit">
            <div>
                <input type="text" placeholder="email" v-model="email" required>
            </div>
            <div>
                <input type="password" placeholder="password" v-model="password" required @input="error" id="password">
                <p v-if="errorPassword">{{ errorPassword }}</p>
                <button @click="viewPassword" type="button">visualiser password</button>
            </div>
            <input type="submit" value="Login">
            <p v-if="errorMessage">{{ errorMessage }}</p>

        </form>
        <NuxtLink to="/register">Register</NuxtLink>
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

        if(!email.value || !password.value){
            errorMessage.value = 'remplissez tous les champs';
            return;
        }

        if(errorPassword.value){
            return;
        }

        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/i;
        if (!emailPattern.test(email.value.trim())) {
            errorMessage.value = 'Veuillez entrer une adresse email valide';
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
        
        navigateTo('/');

    
}

</script>

