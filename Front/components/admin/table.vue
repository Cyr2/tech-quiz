<template>
    <!-- table avec les infos utilisateurs -->
    <!-- Debugging: Show a message if no data is available -->
  <div v-if="!filteredData.length" class="text-center text-red-500">
    No user available to display.
  </div>
  <table v-else class="border-2 border-neutral-light bg-bg-primary">
    <thead>
        <tr>
            <!-- boucle pour afficher tout les noms de colonne -->
            <th 
                v-for="colonne in Object.keys(filteredData[0] || {})" 
                :key="colonne" 
                class="px-4 py-2"
            >
                <!-- si la colonne est username affichage d'un bouton de tri  -->
                <div v-if="colonne === 'username'" class="flex items-center justify-between">
                    {{ colonne }}
                    <button 
                        class="btn btn-primary cursor-pointer rounded-md px-2 py-1"
                        @click="toggleSortOrderUsername"
                    >
                        {{ sortOrderUsername === 'asc' ? '▲' : '▼' }}
                    </button>
                </div>
                <!-- si la colonne est created_at affichage d'un bouton de tri  -->
                <div v-else-if="colonne === 'created_at'" class="flex items-center justify-between">
                    {{ colonne }}
                    <button 
                        class="btn btn-primary cursor-pointer rounded-md px-2 py-1"
                        @click="toggleSortOrderDate"
                    >
                        {{ sortOrderDate === 'asc' ? '▲' : '▼' }}
                    </button>
                </div>
                <span v-else>{{ colonne }}</span>
            </th>
            <th colspan="2" class="px-4 py-2">Action</th>
        </tr>
    </thead>
    <tbody>
        <!-- boucle pour afficher toutes les infos de chaque utilisateurs -->
        <tr v-for="row in filteredData" :key="row.id" class="text-center border-2 border-neutral-light">
            <td v-for="value in row" :key="value" class="px-4 py-2">{{ value }}</td>
            <td class="px-4 py-2"><NuxtLink to="/admin/users/:id/details" class="btn btn-primary bg-neutral-dark-lightest text-bg-primary cursor-pointer rounded-md  px-2 py-1">Details</NuxtLink></td>
            <td class="px-4 py-2"><NuxtLink to="/admin/users/:id/update" class="btn btn-primary bg-highlight-medium text-bg-primary cursor-pointer rounded-md  px-2 py-1">Update</NuxtLink></td>
            <td><button class="bg-support-error-medium text-bg-primary cursor-pointer rounded-md  px-2 py-1 mx-2">Delete</button></td>
        </tr>
    </tbody>
  </table>
  <!-- Afficher quel filtre est actif si il y en a un -->
  <h2 v-if="searched">Username searched: {{ searched }}</h2>
  <h2 v-if="min && max">Created between {{ min }} and {{ max }}</h2>
  <table class="border-2 border-neutral-light bg-bg-primary">
>>>>>>> 00ae9c6 (Admin | css affichage utilisateur)
    <thead>
        <tr>
            <th v-for="colonne in Object.keys(data[0])" :key="colonne" class="px-4 py-2">{{ colonne }}</th>
            <th colspan="2" class="px-4 py-2">Action</th>
        </tr>
    </thead>
    <tbody>
        <tr v-for="row in data" :key="row.id" class="text-center border-2 border-neutral-light">
            <td v-for="value in row" :key="value" class="px-4 py-2">{{ value }}</td>
            <td class="px-4 py-2"><NuxtLink to="/admin/users/:id/update" class="btn btn-primary bg-highlight-medium text-bg-primary cursor-pointer rounded-md  px-2 py-1">Update</NuxtLink></td>
            <td><button class="bg-support-error-medium text-bg-primary cursor-pointer rounded-md  px-2 py-1 mx-2">Delete</button></td>
        </tr>
    </tbody>
  </table>
<<<<<<< HEAD
>>>>>>> 5e5fdd5 (composant tableau admin)
=======
  <!-- Afficher quel filtre est actif si il y en a un -->
  <h2 v-if="searched">Username searched: {{ searched }}</h2>
  <h2 v-if="min && max">Created between {{ min }} and {{ max }}</h2>
>>>>>>> 7c6527c (commentaires)
</template>

<script setup>
    /* definir les props */
    const props = defineProps({
        data: {
            type: Array,
        },
        min: {
            type: String,
        },
        max: {
            type: String,
        },
        searched: {
            type: String,
        },
    });
    
    const sortOrderUsername = ref(null); // null = pas de tri, 'asc' = croissant, 'desc' = descroissant
    const sortOrderDate = ref(null); // null = pas de tri, 'asc' = croissant, 'desc' = descroissant

    const toggleSortOrderUsername = () => {
        if (sortOrderUsername.value === 'asc') {
            sortOrderUsername.value = 'desc';
        } else {
            sortOrderUsername.value = 'asc';
        }
        sortOrderDate.value = null; // Reset date sorting when username sorting is toggled
    };

    const toggleSortOrderDate = () => {
        if (sortOrderDate.value === 'asc') {
            sortOrderDate.value = 'desc';
        } else {
            sortOrderDate.value = 'asc';
        }
        sortOrderUsername.value = null; // Reset username sorting when date sorting is toggled
    };

    /* fonction reactive de filtre */
    const filteredData = computed(() => {
        let result = props.data;

        // Filtrer avec le nom d'utilisateur
        if (props.searched) {
            result = result.filter(row => row.username?.toLowerCase().includes(props.searched.toLowerCase()));
        }

        // Filtrer avec la date de création
        if (props.max && props.min) {
            const maxDate = new Date(props.max);
            const minDate = new Date(props.min);
            result = result.filter(row => new Date(row.created_at) <= maxDate && new Date(row.created_at) >= minDate);
        }

        // Trier par username
        if (sortOrderUsername.value) {
            result = [...result].sort((a, b) => {
                const usernameA = a.username?.toLowerCase() || '';
                const usernameB = b.username?.toLowerCase() || '';
                if (sortOrderUsername.value === 'asc') {
                    return usernameA.localeCompare(usernameB);
                } else {
                    return usernameB.localeCompare(usernameA);
                }
            });
        }

        // Trier par date de création
        if (sortOrderDate.value) {
            result = [...result].sort((a, b) => {
                const dateA = new Date(a.created_at);
                const dateB = new Date(b.created_at);

                return sortOrderDate.value === 'asc' ? dateA - dateB : dateB - dateA;
            });
        }

        return result;
    });
    
</script>