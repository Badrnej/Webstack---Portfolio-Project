<template>
  <div class="bg-gray-100 min-h-screen p-6">
    <div class="max-w-7xl mx-auto">
      <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-8">
        <div class="p-6">
          <div class="flex items-center justify-between mb-6">
            <h2 class="text-3xl font-bold text-gray-800 flex items-center">
              <FileText class="w-8 h-8 mr-2 text-purple-600" />
              Factures
            </h2>
            <button
              @click="toggleForm"
              class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-md text-sm flex items-center transition duration-300 ease-in-out"
            >
              <PlusCircle v-if="!showForm" class="w-5 h-5 mr-2" />
              <XCircle v-else class="w-5 h-5 mr-2" />
              {{ showForm ? 'Annuler' : 'Ajouter une Facture' }}
            </button>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-blue-100 p-4 rounded-lg shadow">
              <h3 class="text-lg font-semibold mb-2 text-blue-800">Total des Factures</h3>
              <p class="text-3xl font-bold text-blue-600">{{ totalInvoices }}</p>
            </div>
            <div class="bg-green-100 p-4 rounded-lg shadow">
              <h3 class="text-lg font-semibold mb-2 text-green-800">Montant Total</h3>
              <p class="text-3xl font-bold text-green-600">{{ totalAmount }} €</p>
            </div>
            <div class="bg-yellow-100 p-4 rounded-lg shadow">
              <h3 class="text-lg font-semibold mb-2 text-yellow-800">Factures en Attente</h3>
              <p class="text-3xl font-bold text-yellow-600">{{ pendingInvoices }}</p>
            </div>
          </div>

          <div class="mb-8">
            <h3 class="text-xl font-semibold mb-4">Répartition des Factures</h3>
            <div class="h-64 flex items-end">
              <div v-for="(value, status) in invoiceStatusDistribution" :key="status" class="flex-1 flex flex-col items-center">
                <div 
                  class="w-full rounded-t transition-all duration-500 ease-in-out" 
                  :class="{
                    'bg-green-500': status === 'Payée',
                    'bg-yellow-500': status === 'En attente',
                    'bg-red-500': status === 'En retard'
                  }"
                  :style="{ height: `${(value / Math.max(...Object.values(invoiceStatusDistribution))) * 100}%` }"
                ></div>
                <span class="text-xs mt-2">{{ status }}</span>
                <span class="text-sm font-semibold">{{ value }}</span>
              </div>
            </div>
          </div>

          <div class="mb-6">
            <div class="relative">
              <input
                v-model="searchQuery"
                type="text"
                placeholder="Rechercher des factures..."
                class="w-full px-4 py-2 border border-gray-300 rounded-md pl-10 focus:outline-none focus:ring-2 focus:ring-purple-500"
              />
              <Search class="w-5 h-5 text-gray-400 absolute left-3 top-1/2 transform -translate-y-1/2" />
            </div>
          </div>

          <AppTable 
            :data="filteredFactures" 
            :columns="tableColumns"
            @editItem="editFacture"
            @deleteItem="deleteFacture"
            class="w-full"
          />
        </div>
      </div>
    </div>

    <FormModal :isVisible="showForm" @close="closeForm">
      <FactureForm 
        :formData="selectedFacture" 
        @submit="handleSubmit" 
      />
    </FormModal>
  </div>
</template>

<script setup>
import { computed, ref, onMounted } from 'vue'
import { useStore } from 'vuex'
import { FileText, PlusCircle, XCircle, Search } from 'lucide-vue-next'
import AppTable from '@/components/Dashboard/table/AppTable.vue'
import FactureForm from '@/components/Form/FactureForm.vue'
import FormModal from '@/components/utils/Modal.vue'

const store = useStore()
const showForm = ref(false)
const selectedFacture = ref(null)
const searchQuery = ref('')

const factures = computed(() => store.getters.getFactures)

const filteredFactures = computed(() => {
  return factures.value.filter(facture => 
    facture.number.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
    facture.client.toLowerCase().includes(searchQuery.value.toLowerCase())
  )
})

const totalInvoices = computed(() => factures.value.length)
const totalAmount = computed(() => factures.value.reduce((sum, facture) => sum + facture.amount, 0).toFixed(2))
const pendingInvoices = computed(() => factures.value.filter(facture => facture.status === 'En attente').length)

const invoiceStatusDistribution = computed(() => {
  const distribution = { 'Payée': 0, 'En attente': 0, 'En retard': 0 }
  factures.value.forEach(facture => {
    distribution[facture.status]++
  })
  return distribution
})

const tableColumns = [
  { key: 'number', label: 'Numéro' },
  { key: 'client', label: 'Client' },
  { key: 'date', label: 'Date' },
  { key: 'amount', label: 'Montant' },
  { key: 'status', label: 'Statut' },
]

onMounted(() => {
  store.dispatch('fetchFactures')
})

function toggleForm() {
  showForm.value = !showForm.value
  if (showForm.value) {
    selectedFacture.value = null
  }
}

function closeForm() {
  showForm.value = false
}

function handleSubmit(formData) {
  if (selectedFacture.value) {
    store.dispatch('updateFacture', { ...formData, id: selectedFacture.value.id })
  } else {
    store.dispatch('createFacture', formData)
  }
  closeForm()
}

function editFacture(facture) {
  selectedFacture.value = { ...facture }
  showForm.value = true
}

function deleteFacture(factureId) {
  if (confirm('Êtes-vous sûr de vouloir supprimer cette facture ?')) {
    store.dispatch('deleteFacture', factureId)
  }
}
</script>

<style scoped>
@keyframes growUp {
  from { height: 0; }
  to { height: 100%; }
}

.h-64 > div > div {
  animation: growUp 1s ease-out;
}
</style>