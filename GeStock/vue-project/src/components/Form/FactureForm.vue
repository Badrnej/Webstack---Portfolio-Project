<template>
  <form @submit.prevent="submitForm" class="max-w-2xl mx-auto p-4">
    <div class="grid grid-cols-2 gap-4">
      <div class="mb-4">
        <label for="in_client" class="block mb-2 font-medium">Client</label>
        <select
          v-model="formData.in_client"
          id="in_client"
          class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-purple-700"
          required
        >
          <option value="">Sélectionnez un client</option>
          <option v-for="client in clients" :key="client.id" :value="client.id">
            {{ client.name }}
          </option>
        </select>
      </div>
      
      <div class="mb-4">
        <label for="created_at" class="block mb-2 font-medium">Date de création</label>
        <input
          v-model="formData.created_at"
          type="date"
          id="created_at"
          class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-purple-700"
          required
        />
      </div>
    </div>
    
    <div class="mb-4">
      <label for="les_prodact" class="block mb-2 font-medium">Produits</label>
      <textarea
        v-model="formData.les_prodact"
        id="les_prodact"
        rows="3"
        class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-purple-700"
        placeholder="Entrez les détails des produits"
        required
      ></textarea>
    </div>
    
    <div class="mb-4">
      <label for="price_totale" class="block mb-2 font-medium">Prix Total</label>
      <input
        v-model.number="formData.price_totale"
        type="number"
        id="price_totale"
        class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-purple-700"
        required
      />
    </div>
    
    <button type="submit" class="w-full bg-purple-700 text-white py-2 rounded-lg hover:bg-orange-400">
      {{ formData.id ? 'Mettre à jour la facture' : 'Générer la facture' }}
    </button>
  </form>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useStore } from 'vuex'

const store = useStore()

const props = defineProps({
  formData: {
    type: Object,
    default: () => ({})
  }
})

const emit = defineEmits(['submit'])


const clients = ref([])

onMounted(async () => {
  if (props.formData.id) {
    formData.value = { 
      ...props.formData,
      created_at: props.formData.created_at ? new Date(props.formData.created_at).toISOString().split('T')[0] : new Date().toISOString().split('T')[0]
    }
  }
  await fetchClients()
})

async function fetchClients() {
  try {
    const response = await store.dispatch('fetchClients')
    clients.value = response
  } catch (error) {
    console.error('Error fetching clients:', error)
  }
}

function submitForm() {
  emit('submit', formData.value)
}
</script>