<template>
  <table class="border-2 border-neutral-light bg-bg-primary">
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
</template>

<script setup>
    const props = defineProps({
        data: {
            type: Array,
        },
    });
    
</script>