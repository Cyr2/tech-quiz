<template>
  <table>
    <thead>
        <tr>
            <th v-for="colonne in Object.keys(data[0])" :key="colonne">{{ colonne }}</th>
        </tr>
    </thead>
    <tbody>
        <tr v-for="row in data" :key="row.id">
            <td v-for="value in row" :key="value">{{ value }}</td>
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