<template>
    <div class="flex flex-col items-center gap-6">
        <div class="flex justify-between w-full">
            <h1 class="">Users</h1>
            <NuxtLink to="/admin/users/create" class="btn btn-primary bg-support-success-medium rounded-md text-bg-primary px-2 py-1">Create</NuxtLink>
        </div>
        <AdminTable v-if="data" :data="data" />
    </div>
</template>

<script setup>
    import { fetchUsers } from "../../../utils/fetchUsers";

    const data = ref(null);

    onMounted(async () => {
        data.value = await fetchUsers();
    });
</script>