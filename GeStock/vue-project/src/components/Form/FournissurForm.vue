<template>
  <form @submit.prevent="submitForm" class="max-w-md mx-auto p-4">
    <div class="grid grid-cols-2 gap-4">
      <div class="mb-4">
        <label for="nom" class="block mb-2 font-medium">Nom du contact</label>
        <input
          v-model="formData.nom"
          type="text"
          id="nom"
          class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-purple-700"
        />
      </div>
      
      <div class="mb-4">
        <label for="email" class="block mb-2 font-medium">Email</label>
        <input
          v-model="formData.email"
          type="email"
          id="email"
          class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-purple-700"
          required
        />
      </div>
    </div>
    
    <div class="mb-4">
      <label for="phone" class="block mb-2 font-medium">Téléphone</label>
      <input
        v-model="formData.phone"
        type="tel"
        id="phone"
        class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-purple-700"
      />
    </div>
    
    <div class="mb-4">
      <label for="address" class="block mb-2 font-medium">Adresse</label>
      <textarea
        v-model="formData.address"
        id="address"
        rows="3"
        class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-purple-700"
      ></textarea>
    </div>
    
    <button type="submit" class="w-full bg-purple-700 text-white py-2 rounded-lg hover:bg-orange-400">
      {{ initialData && initialData.id ? 'Mettre à jour le fournisseur' : 'Enregistrer le fournisseur' }}
    </button>
  </form>
</template>

<script setup>
import { ref, watch } from 'vue'

const props = defineProps({
  initialData: {
    type: Object,
    default: () => ({
      id: '',
      nom: '',
      email: '',
      phone: '',
      address: ''
    })
  }
})

const emit = defineEmits(['submit'])

const formData = ref({ ...props.initialData })

watch(() => props.initialData, (newValue) => {
  formData.value = { ...newValue }
}, { deep: true })

function submitForm() {
  emit('submit', formData.value)
}
</script>