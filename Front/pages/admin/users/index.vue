<template>
    <div class="flex flex-col items-center gap-6">
        <div class="flex justify-between w-full">
            <h1 class="">Users</h1>
            <div class="flex gap-20">
                <div class="flex gap-4">
                    <input type="text" id="search">
                    <button class="text-highlight-medium" @click="search">Search</button>
                </div>
                <div class="flex gap-4">
                    <input type="date" id="min" @input="updateMin">
                    <input type="date" id="max" :min="min" @input="updateMax">
                    <button class="text-highlight-medium" @click="find">Find</button>
                </div>
            </div>
            <NuxtLink to="/admin/users/create" class="btn btn-primary bg-support-success-medium rounded-md text-bg-primary px-2 py-1">Create</NuxtLink>
        </div>
        <AdminTable v-if="data" :data="data" :min="min" :max="max" :searched="searched" />
    </div>
</template>

<script setup>
    import { fetchUsers } from "../../../utils/fetchUsers";

    /* defining the variables */
    const data = ref(null);
    const min = ref(null);
    const max = ref(null);
    const searched = ref(null);

    /* function to fetch the users */
    onMounted(async () => {
        data.value = await fetchUsers();
    });

    /* function to update the value of min and verify that max is superior, if not then resets it*/
    const updateMin = () => {
        min.value = document.getElementById("min").value;
        if (max.value && new Date(max.value) < new Date(min.value)) {
            max.value = null;
            document.getElementById("max").value = null;
        }
        resetSearch();
    };

    /* function to update the value of max */
    const updateMax = () => {
        max.value = document.getElementById("max").value;
        resetSearch();
    };

    /* function to set the variables in order to find users having a date of creation in between the two values enterred*/
    const find = () => {
        updateMin();
        updateMax();
        resetSearch();
    };

    /* function to set the searched variable */
    function search() {
        searched.value = document.getElementById("search").value;
        resetDates();  
    }

    /* function to reset elements corresponding to the search of a username */
    function resetSearch () {
        searched.value = null;
        document.getElementById("search").value = null;
    };

    /* function to reset elements corresponding to the search of a date */
    function resetDates () {
        min.value = null;
        max.value = null;   
        document.getElementById("max").value = null;
        document.getElementById("min").value = null;
    };

</script>