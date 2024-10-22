<template>
  <div class="bg-white rounded-lg shadow-md overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
      <h2 class="text-lg font-semibold text-gray-800">{{ title }}</h2>
      <div class="flex items-center space-x-2">
        <input
          v-model="search"
          type="text"
          placeholder="Search..."
          class="px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
        />
        <button
          @click="toggleColumns"
          class="p-2 text-gray-500 hover:text-gray-700 focus:outline-none"
          title="Toggle Columns"
        >
          <Columns class="w-5 h-5" />
        </button>
      </div>
    </div>
    <div class="p-6 overflow-x-auto">
      <table class="w-full" v-if="filteredData.length > 0">
        <thead>
          <tr>
            <th
              v-for="column in visibleColumns"
              :key="column"
              @click="sort(column)"
              class="text-left text-xs font-medium text-gray-500 uppercase tracking-wider pb-3 cursor-pointer hover:text-gray-700"
            >
              {{ column }}
              <span v-if="sortColumn === column">
                {{ sortDirection === 'asc' ? '▲' : '▼' }}
              </span>
            </th>
            <th class="text-left text-xs font-medium text-gray-500 uppercase tracking-wider pb-3">Action</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="item in paginatedData" :key="item.id" class="border-t border-gray-200 hover:bg-gray-50">
            <td
              v-for="column in visibleColumns"
              :key="column"
              class="py-4 text-sm text-gray-900"
            >
              {{ item[column] }}
            </td>
            <td class="py-4 text-sm text-gray-900">
              <button
                @click="$emit('editItem', item)"
                class="text-blue-500 hover:text-blue-700 focus:outline-none mr-2"
                title="Edit"
              >
                <Edit2 class="w-4 h-4" />
              </button>
              <button
                @click="confirmDelete(item.id)"
                class="text-red-500 hover:text-red-700 focus:outline-none"
                title="Delete"
              >
                <Trash2 class="w-4 h-4" />
              </button>
            </td>
          </tr>
        </tbody>
      </table>
      <div v-else class="text-center py-4 text-gray-500">
        No data available
      </div>
    </div>
    <div v-if="filteredData.length > 0" class="px-6 py-4 border-t border-gray-200 flex justify-between items-center">
      <div class="text-sm text-gray-700">
        Showing {{ startIndex + 1 }} to {{ endIndex }} of {{ filteredData.length }} entries
      </div>
      <div class="flex space-x-2">
        <button
          @click="prevPage"
          :disabled="currentPage === 1"
          class="px-3 py-1 border border-gray-300 rounded-md text-sm disabled:opacity-50"
        >
          Previous
        </button>
        <button
          @click="nextPage"
          :disabled="currentPage === totalPages"
          class="px-3 py-1 border border-gray-300 rounded-md text-sm disabled:opacity-50"
        >
          Next
        </button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, watch } from 'vue'
import { Columns, Edit2, Trash2 } from 'lucide-vue-next'

const props = defineProps({
  title: {
    type: String,
    required: true
  },
  data: {
    type: Array,
    required: true
  },
  itemsPerPage: {
    type: Number,
    default: 10
  }
})

const emit = defineEmits(['editItem', 'deleteItem'])

const search = ref('')
const sortColumn = ref('')
const sortDirection = ref('asc')
const currentPage = ref(1)
const visibleColumns = ref([])

const filteredData = computed(() => {
  let result = props.data
  if (search.value) {
    const searchLower = search.value.toLowerCase()
    result = result.filter(item => 
      Object.values(item).some(val => 
        val.toString().toLowerCase().includes(searchLower)
      )
    )
  }
  if (sortColumn.value) {
    result = [...result].sort((a, b) => {
      if (a[sortColumn.value] < b[sortColumn.value]) return sortDirection.value === 'asc' ? -1 : 1
      if (a[sortColumn.value] > b[sortColumn.value]) return sortDirection.value === 'asc' ? 1 : -1
      return 0
    })
  }
  return result
})

const totalPages = computed(() => Math.ceil(filteredData.value.length / props.itemsPerPage))
const startIndex = computed(() => (currentPage.value - 1) * props.itemsPerPage)
const endIndex = computed(() => Math.min(startIndex.value + props.itemsPerPage, filteredData.value.length))

const paginatedData = computed(() => 
  filteredData.value.slice(startIndex.value, endIndex.value)
)

watch(() => props.data, () => {
  if (props.data.length > 0 && visibleColumns.value.length === 0) {
    visibleColumns.value = Object.keys(props.data[0])
    console.log(visibleColumns.value)
  }
}, { immediate: true })

function sort(column) {
  if (sortColumn.value === column) {
    sortDirection.value = sortDirection.value === 'asc' ? 'desc' : 'asc'
  } else {
    sortColumn.value = column
    sortDirection.value = 'asc'
  }
}

function prevPage() {
  if (currentPage.value > 1) {
    currentPage.value--
  }
}

function nextPage() {
  if (currentPage.value < totalPages.value) {
    currentPage.value++
  }
}

function toggleColumns() {
  // Implement column toggling logic here
  // This could open a modal or dropdown to select visible columns
}

function confirmDelete(id) {
  if (confirm('Are you sure you want to delete this item?')) {
    emit('deleteItem', id)
  }
}
</script>

<style scoped>
/* Add any additional styles here */
</style>