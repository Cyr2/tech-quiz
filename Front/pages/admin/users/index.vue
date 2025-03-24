<template>
    <h1>Users</h1>
    <AdminTable v-if="data" :data="data" />
</template>

<script setup>
    import { fetchUsers } from "../../../utils/fetchUsers";

    const data = ref(null);

    onMounted(async () => {
        data.value = await fetchUsers();
    });
</script>