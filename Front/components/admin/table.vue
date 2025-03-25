<template>
    <!-- table with user infos -->
  <table class="border-2 border-neutral-light bg-bg-primary">
    <thead>
        <tr>
            <!-- loop to display every key -->
            <th v-for="colonne in Object.keys(filteredData[0] || {})" :key="colonne" class="px-4 py-2">{{ colonne }}</th>
            <th colspan="2" class="px-4 py-2">Action</th>
        </tr>
    </thead>
    <tbody>
        <!-- loop to display every users -->
        <tr v-for="row in filteredData" :key="row.id" class="text-center border-2 border-neutral-light">
            <td v-for="value in row" :key="value" class="px-4 py-2">{{ value }}</td>
            <td class="px-4 py-2"><NuxtLink to="/admin/users/:id/update" class="btn btn-primary bg-highlight-medium text-bg-primary cursor-pointer rounded-md  px-2 py-1">Update</NuxtLink></td>
            <td><button class="bg-support-error-medium text-bg-primary cursor-pointer rounded-md  px-2 py-1 mx-2">Delete</button></td>
        </tr>
    </tbody>
  </table>
  <!-- display which filter is active -->
  <h2 v-if="searched">Username searched: {{ searched }}</h2>
  <h2 v-if="min && max">Created between {{ min }} and {{ max }}</h2>
</template>

<script setup>
    /* define props */
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
    
    /* reactive function to filter */
    const filteredData = computed(() => {
        let result = props.data;

        // Filter by searched username
        if (props.searched) {
            result = result.filter(row => row.username?.toLowerCase().includes(props.searched.toLowerCase()));
        }

        // Filter between two dates
        if (props.max && props.min) {
            const maxDate = new Date(props.max);
            const minDate = new Date(props.min);
            result = result.filter(row => new Date(row.created_at) <= maxDate && new Date(row.created_at) >= minDate);
        }

        return result;
    });
</script>