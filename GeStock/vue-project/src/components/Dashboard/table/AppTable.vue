<template>
  <div class="bg-white rounded-lg shadow-md overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-200">
      <h2 class="text-lg font-semibold text-gray-800">{{ title }}</h2>
    </div>
    <div class="p-6">
      <table class="w-full" v-if="data.length > 0">
        <thead>
          <tr>
            <th v-for="(_, key) in data[0]" :key="key" class="text-left text-xs font-medium text-gray-500 uppercase tracking-wider pb-3">
              {{ key }}
            </th>
            <th class="text-left text-xs font-medium text-gray-500 uppercase tracking-wider pb-3">Action</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="item in data" :key="item.id" class="border-t border-gray-200">
            <td v-for="(value, key) in item" :key="key" class="py-4 text-sm text-gray-900">
              {{ value }}
            </td>
            <td class="py-4 text-sm text-gray-900">
              <button @click="$emit('editItem', item)" class="text-blue-500 hover:text-blue-700 focus:outline-none" title="Modifier">
                <i class="fas fa-edit"></i>
              </button>
              <button @click="$emit('deleteItem', item.id)" class="text-red-500 hover:text-red-700 focus:outline-none" title="Supprimer">
                <i class="fas fa-trash-alt"></i>
              </button>
            </td>
          </tr>
        </tbody>
      </table>
      <div v-else>
        Pas de données
      </div>
    </div>
  </div>
</template>

<script setup>
defineProps({
  title: {
    type: String,
    required: true
  },
  data: {
    type: Array,
    required: true
  }
});
</script>

<style scoped>
/* Add any additional styles here */
</style>