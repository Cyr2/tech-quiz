<template>
  <div class="w-full">
    <div class="mb-4 flex justify-between items-center">
      <input 
        v-if="props.search"
        v-model="searchTerm" 
        placeholder="Rechercher..." 
        class="px-3 py-2 border rounded-md w-full max-w-md focus:outline-none focus:ring-2 focus:ring-highlight-medium"
      />
    </div>
    <div v-if="filteredData && filteredData.length" class="overflow-x-auto border-2 border-black bg-bg-primary rounded-md">
      <table class="w-full border-collapse">
        <thead class="bg-bg-primary border-b-2 border-black">
          <tr>
            <th 
              v-for="(key) in tableHeaders" 
              :key="key" 
              @click="updateSort(key)"
              class="px-4 py-3 text-left text-xs font-medium text-text-primary uppercase tracking-wider cursor-pointer"
            >
              {{ formatHeader(key) }}
              <span v-if="sortKey === key" class="ml-2">
                {{ sortOrder === 'asc' ? '▲' : '▼' }}
              </span>
            </th>
          </tr>
        </thead>
        <tbody>
          <tr 
            v-for="item in filteredData" 
            :key="item.id || JSON.stringify(item)" 
            class="odd:bg-bg-secondary"
          >
            <td 
              v-for="key in tableHeaders" 
              :key="key" 
              class="px-4 py-3 text-sm"
            >
              {{ formatCellValue(item[key]) }}
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div v-else class="w-full flex flex-col gap-2">
      <USkeleton v-for="i in 3" :key="i" class="h-10 w-full" />
    </div>
  </div>
</template>

<script setup>
import { ref, computed, watch, onMounted } from 'vue'

const props = defineProps({
  data: {
    type: Array,
    default: () => []
  },
  search: {
    type: Boolean,
    default: false
  }
})



const searchTerm = ref('')
const sortKey = ref(null)
const sortOrder = ref('asc')

const tableHeaders = computed(() => {
  if (props.data.length === 0) return []
  return Object.keys(props.data[0])
})

const filteredData = computed(() => {
  let result = [...props.data]

  // Recherche
  if (props.search && searchTerm.value) {
    result = result.filter(item => 
      Object.values(item).some(value => 
        String(value).toLowerCase().includes(searchTerm.value.toLowerCase())
      )
    )
  }

  // Tri
  if (sortKey.value) {
    result.sort((a, b) => {
      const valA = a[sortKey.value]
      const valB = b[sortKey.value]

      if (typeof valA === 'number' && typeof valB === 'number') {
        return sortOrder.value === 'asc' ? valA - valB : valB - valA
      }

      if (typeof valA === 'string' && typeof valB === 'string') {
        return sortOrder.value === 'asc' 
          ? valA.localeCompare(valB) 
          : valB.localeCompare(valA)
      }

      return 0
    })
  }

  return result
})

const updateSort = (key) => {
  if (sortKey.value === key) {
    // Si on clique sur la même colonne, on inverse l'ordre de tri
    sortOrder.value = sortOrder.value === 'asc' ? 'desc' : 'asc'
  } else {
    // Sinon, on change la colonne de tri
    sortOrder.value = 'desc'
    sortKey.value = key
  }
}

const formatHeader = (header) => {
  // Transforme le header en texte lisible
  return header
    .replace(/_/g, ' ')
    .replace(/\b\w/g, l => l.toUpperCase())
}

const formatCellValue = (value) => {
  // Formater les valeurs (dates, nombres, etc.)
  if (value instanceof Date) {
    return value.toLocaleDateString()
  }
  return value
}
</script>