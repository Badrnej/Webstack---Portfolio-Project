<template>
  <form @submit.prevent="submitForm" class="space-y-4">
    <div>
      <label for="name" class="block text-sm font-medium text-gray-700">Nom</label>
      <input v-model="form.name" type="text" id="name" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
    </div>
    <div>
      <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
      <input v-model="form.email" type="email" id="email" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
    </div>
    <div>
      <label for="role" class="block text-sm font-medium text-gray-700">Rôle</label>
      <select v-model="form.role" id="role" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
        <option value="Admin">Admin</option>
        <option value="Manager">Manager</option>
        <option value="User">User</option>
        <option value="Guest">Guest</option>
      </select>
    </div>
    <div>
      <label for="status" class="block text-sm font-medium text-gray-700">Statut</label>
      <select v-model="form.status" id="status" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
        <option value="Active">Active</option>
        <option value="Inactive">Inactive</option>
      </select>
    </div>
    <div v-if="!formData">
      <label for="password" class="block text-sm font-medium text-gray-700">Mot de passe</label>
      <input v-model="form.password" type="password" id="password" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
    </div>
    <div>
      <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-purple-600 hover:bg-orange-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
        {{ formData ? 'Mettre à jour' : 'Créer' }} l'utilisateur
      </button>
    </div>
  </form>
</template>

<script setup>
import { ref, watch } from 'vue'

const props = defineProps({
  formData: {
    type: Object,
    default: () => null
  }
})

const emit = defineEmits(['submit'])

const form = ref({
  name: '',
  email: '',
  role: 'User',
  status: 'Active',
  password: ''
})

watch(() => props.formData, (newFormData) => {
  if (newFormData) {
    form.value = { ...newFormData }
    delete form.value.password // Remove password field when editing
  } else {
    form.value = {
      name: '',
      email: '',
      role: 'User',
      status: 'Active',
      password: ''
    }
  }
}, { immediate: true })

const submitForm = () => {
  emit('submit', form.value)
}
</script>