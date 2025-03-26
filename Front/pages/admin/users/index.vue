<template>
    <div class="flex flex-col items-center gap-6">
        <div class="flex justify-between w-full">
            <h1 class="">Users</h1>
            <div class="flex gap-20">
                <div class="flex gap-4">
                    <input type="text" id="search">
                    <button class="text-support-success-medium" @click="search">Search</button>
                </div>
                <div class="flex gap-4">
                    <input type="date" id="min" @input="updateMin">
                    <input type="date" id="max" :min="min" @input="updateMax">
                    <button class="text-support-success-medium" @click="find">Find</button>
                </div>
            </div>
            <NuxtLink to="/admin/users/create" class="btn btn-primary bg-support-success-medium rounded-md text-bg-primary px-2 py-1">Create</NuxtLink>
        </div>
        <AdminTable v-if="data" :data="data" :min="min" :max="max" :searched="searched" />
    </div>
</template>

<script setup>
    import { fetchUsers } from "../../../utils/fetchUsers";

    /* definir les variables */
    const data = ref(null);
    const min = ref(null);
    const max = ref(null);
    const searched = ref(null);

    /* fonction pour fetch les utilisateurs */
    onMounted(async () => {
        data.value = await fetchUsers();
    });

    /* fonction pour mettre à jour les valeurs de min, si min est superieur à max alors max est reinitialiser*/
    const updateMin = () => {
        min.value = document.getElementById("min").value;
        if (max.value && new Date(max.value) < new Date(min.value)) {
            max.value = null;
            document.getElementById("max").value = null;
        }
        resetSearch();
    };

    /* fonction pour mettre à jour max */
    const updateMax = () => {
        max.value = document.getElementById("max").value;
        resetSearch();
    };

    /* fonction pour définir les variables afin de pouvoir chercher avec la date minimum et maximum*/
    const find = () => {
        updateMin();
        updateMax();
        resetSearch();
    };

    /* fonction pour définir l'utilisateur recherché */
    function search() {
        searched.value = document.getElementById("search").value;
        resetDates();  
    }

    /* fonction pour réinitialiser les éléments correspondant au filtre d'utilisateur */
    function resetSearch () {
        searched.value = null;
        document.getElementById("search").value = null;
    };

    /* fonction pour réinitialiser les éléments correspondant au filtre de date */
    function resetDates () {
        min.value = null;
        max.value = null;   
        document.getElementById("max").value = null;
        document.getElementById("min").value = null;
    };

</script>