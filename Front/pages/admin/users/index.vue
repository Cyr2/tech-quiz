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
        <!-- composant + props envoyées -->
        <AdminTable
            v-if="data"
            :data="data"
            :min="min"
            :max="max"
            :searched="searched"
            @delete-user="deleteUser"
        />
    </div>
</template>

<script setup>
    import { fetchUsers } from "../../../utils/fetchUsers";
    import { fetchDeleteUser } from "../../../utils/fetchDeleteUser";

    /* définition des variables */
    const data = ref(null);
    const min = ref(null);
    const max = ref(null);
    const searched = ref(null);

    onMounted(async () => {
        data.value = await fetchUsers();
    });

    /* fonction pour mettre à jour les valeurs de la date minimale */
    const updateMin = () => {
        min.value = document.getElementById("min").value;
        if (max.value && new Date(max.value) < new Date(min.value)) {
            max.value = null;
            document.getElementById("max").value = null;
        }
        resetSearch();
    };

    /* fonction pour mettre à jour les valeurs de la date maximale */
    const updateMax = () => {
        max.value = document.getElementById("max").value;
        resetSearch();
    };

    /* fonction pour activer le filtre des dates */
    const find = () => {
        updateMin();
        updateMax();
        resetSearch();
    };

    /* fonction pour activer le filtre de la recherche */
    function search() {
        searched.value = document.getElementById("search").value;
        resetDates();  
    }

    /* fonction pour réinitialiser les valeurs de la recherche */
    function resetSearch () {
        searched.value = null;
        document.getElementById("search").value = null;
    };

    /* fonction pour réinitialiser les valeurs des dates */
    function resetDates () {
        min.value = null;
        max.value = null;   
        document.getElementById("max").value = null;
        document.getElementById("min").value = null;
    };

    /* fonction pour supprimer l'utilisateur demandé */
    const deleteUser = async (userId) => {
        const confirmDelete = confirm("Do you want to delete this user?");
        if (!confirmDelete) return;

        console.log("Deleting user with ID:", userId);
        
        try {
            const response = await fetchDeleteUser(userId);
            if (response.error) {
                alert(`Error: ${response.error}`);
                return;
            }

            // Retirer l'utilisateur supprimé de la liste
            data.value = data.value.filter(user => user.user_id !== userId);
            alert("User deleted successfully.");
        } catch (error) {
            console.error("Error deleting user:", error);
            alert("An error occurred while deleting the user.");
        }
    };
</script>