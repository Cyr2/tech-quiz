<template>
    <div class="flex flex-col justify-center items-center">
        <div class="flex flex-col justify-between items-center bg-bg-primary p-14 rounded-2xl shadow-md gap-4">
            <h1 class="font-medium text-2xl text-text-primary">Update user</h1>
            <!-- formulaire contenant les informations d'un utilisateur -->
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
                    <!-- bouton permettant de visualiser le mot de passe -->
                    <div class="flex items-center gap-2">
                        <input type="password" placeholder="password" v-model="password" required @input="error" id="password" class="rounded-lg bg-bg-secondary p-3 border-2 w-10/12">
                        <button @click="viewPassword" type="button" class="bg-highlight-medium text-neutral-light-medium px-4 py-3 text-base rounded-lg "><img src="../../../../public/assets/yeux.png" alt="yeux" class="w-9"></button>
                    </div>
                    <p v-if="errorPassword" class="text-support-error-medium">{{ errorPassword }}</p>
                </div>
                <!-- selection du role de l'utilisateur -->
                <div class="flex flex-col w-full gap-2">
                    <label for="role" class="text-text-primary">Role</label>
                    <select name="role" id="role" class="rounded-lg bg-bg-secondary p-3 border-2" v-model="role" required>
                        <option value="2">User</option>
                        <option value="1">Admin</option>
                    </select>
                </div>
                <input type="submit" value="Update" class="bg-highlight-medium text-neutral-dark-dark px-4 py-2 w-full mt-4 text-base rounded-lg" :disabled="submitted">
                <p v-if="errorMessage" class="text-support-error-medium">{{ errorMessage }}</p>
            </form>
            <!-- lien pour retourner vers l'affichage de tout les utilisateurs -->
            <NuxtLink to="/admin/users" class="text-highlight-medium underline decoration-solid">Cancel</NuxtLink>
        </div>
    </div>
</template>

<script setup>

import { useRoute } from 'vue-router';
import { useAuth } from "../stores/auth.js";
import { fetchUser } from "../../../../utils/fetchUser";
import { fetchUpdateUser } from "../../../../utils/fetchUpdateUser";


definePageMeta({
    layout: 'auth'
});

/* définition des variables */
const route = useRoute();
const id = computed(() => route.params.id);
const user = useAuth();

const update = ref(null);
const email = ref(user.email);
const username = ref(user.username);
const password = ref(user.password);
const errorMessage = ref('');
const errorPassword = ref('');
const submitted = ref(false);
const role = ref(user.role);

/* fonction executée lors du chargement de la page */
onMounted(async () => {
    const user = await fetchUser(id);
    email.value = user.email;
    username.value = user.username;
    role.value = user.role;
});


/* fonction pour la visualisation du mot de passe */
const viewPassword = () => {
    const input = document.querySelector('#password');
    if(input.type === 'password'){
        input.type = 'text';
    }else{
        input.type = 'password';
    }
};

/* fonction pour gérer les erreurs */
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

/* fonction pour valider l'envoi du formulaire et la modification de l'utilisateur */
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

    submitted.value = true;
    //update.value = await fetchUpdateUser(id.value,);
    if (update.value.error) {
        submitted.value = false;
        errorMessage.value = update.value.error;
        return;
    } else {
        errorMessage.value = '';
    }


    //navigateTo('/admin/users');

};

</script>