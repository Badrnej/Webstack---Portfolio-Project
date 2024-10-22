<template>
  <div class="bg-gray-100 min-h-screen p-6">
    <div class="max-w-7xl mx-auto">
      <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-8">
        <div class="p-6">
          <div class="flex items-center justify-between mb-6">
            <h2 class="text-3xl font-bold text-gray-800 flex items-center">
              <Truck class="w-8 h-8 mr-2 text-purple-600" />
              Fournisseurs
            </h2>
            <button
              @click="toggleForm"
              class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-md text-sm flex items-center transition duration-300 ease-in-out"
            >
              <PlusCircle v-if="!showForm" class="w-5 h-5 mr-2" />
              <XCircle v-else class="w-5 h-5 mr-2" />
              {{ showForm ? 'Annuler' : 'Ajouter un fournisseur' }}
            </button>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-blue-100 p-4 rounded-lg shadow">
              <h3 class="text-lg font-semibold mb-2 text-blue-800">Total des Fournisseurs</h3>
              <p class="text-3xl font-bold text-blue-600">{{ totalSuppliers }}</p>
            </div>
            <div class="bg-green-100 p-4 rounded-lg shadow">
              <h3 class="text-lg font-semibold mb-2 text-green-800">Fournisseurs Actifs</h3>
              <p class="text-3xl font-bold text-green-600">{{ activeSuppliers }}</p>
            </div>
            <div class="bg-yellow-100 p-4 rounded-lg shadow">
              <h3 class="text-lg font-semibold mb-2 text-yellow-800">Nouveaux Fournisseurs (30j)</h3>
              <p class="text-3xl font-bold text-yellow-600">{{ newSuppliers }}</p>
            </div>
          </div>

          <div class="mb-8">
            <h3 class="text-xl font-semibold mb-4">Répartition des Fournisseurs par Catégorie</h3>
            <div class="h-64 flex items-end">
              <div v-for="(value, category) in supplierCategoryDistribution" :key="category" class="flex-1 flex flex-col items-center">
                <div 
                  class="w-full rounded-t transition-all duration-500 ease-in-out" 
                  :style="{ 
                    height: `${(value / Math.max(...Object.values(supplierCategoryDistribution))) * 100}%`,
                    backgroundColor: getCategoryColor(category)
                  }"
                ></div>
                <span class="text-xs mt-2">{{ category }}</span>
                <span class="text-sm font-semibold">{{ value }}</span>
              </div>
            </div>
          </div>

          <div class="mb-6">
            <div class="relative">
              <input
                v-model="searchQuery"
                type="text"
                placeholder="Rechercher des fournisseurs..."
                class="w-full px-4 py-2 border border-gray-300 rounded-md pl-10 focus:outline-none focus:ring-2 focus:ring-purple-500"
              />
              <Search class="w-5 h-5 text-gray-400 absolute left-3 top-1/2 transform -translate-y-1/2" />
            </div>
          </div>

          <AppTable 
            :data="fournisseurs" 
            :columns="tableColumns"
            @editItem="editSupplier"
            @deleteItem="deleteSupplier"
            class="w-full"
          />
        </div>
      </div>
    </div>

    <FormModal :isVisible="showForm" @close="closeForm">
      <FournissurForm 
        :formData="selectedSupplier" 
        @submit="handleSubmit" 
      />
    </FormModal>
  </div>
</template>

<script setup>
import { computed, ref, onMounted } from 'vue'
import { useStore } from 'vuex'
import { Truck, PlusCircle, XCircle, Search } from 'lucide-vue-next'
import AppTable from '@/components/Dashboard/table/AppTable.vue'
import FournissurForm from '@/components/Form/FournissurForm.vue'
import FormModal from '@/components/utils/Modal.vue'

const store = useStore()
const showForm = ref(false)
const selectedSupplier = ref(null)
const searchQuery = ref('')

const fournisseurs = computed(() => {
  return store.getters.getFournisseurs.filter(fournisseur => 
    fournisseur.name.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
    fournisseur.email.toLowerCase().includes(searchQuery.value.toLowerCase())
  )
})

const totalSuppliers = computed(() => fournisseurs.value.length)
const activeSuppliers = computed(() => fournisseurs.value.filter(supplier => supplier.status === 'Actif').length)
const newSuppliers = computed(() => {
  const thirtyDaysAgo = new Date(Date.now() - 30 * 24 * 60 * 60 * 1000)
  return fournisseurs.value.filter(supplier => new Date(supplier.createdAt) > thirtyDaysAgo).length
})

const supplierCategoryDistribution = computed(() => {
  const distribution = {}
  fournisseurs.value.forEach(supplier => {
    distribution[supplier.category] = (distribution[supplier.category] || 0) + 1
  })
  return distribution
})

const tableColumns = [
  { key: 'name', label: 'Nom' },
  { key: 'category', label: 'Catégorie' },
  { key: 'contact', label: 'Contact' },
  { key: 'email', label: 'Email' },
  { key: 'status', label: 'Statut' },
]

onMounted(() => {
  store.dispatch('fetchFournisseurs')
})

function toggleForm() {
  showForm.value = !showForm.value
  if (showForm.value) {
    selectedSupplier.value = null
  }
}

function closeForm() {
  showForm.value = false
}

function handleSubmit(formData) {
  if (selectedSupplier.value) {
    store.dispatch('updateFournisseur', { ...formData, id: selectedSupplier.value.id })
  } else {
    store.dispatch('createFournisseur', formData)
  }
  closeForm()
}

function editSupplier(supplier) {
  selectedSupplier.value = { ...supplier }
  showForm.value = true
}

function deleteSupplier(supplierId) {
  if (confirm('Êtes-vous sûr de vouloir supprimer ce fournisseur ?')) {
    store.dispatch('deleteFournisseur', supplierId)
  }
}

function getCategoryColor(category) {
  const colors = ['#FF6B6B', '#4ECDC4', '#45B7D1', '#FFA07A', '#98D8C8', '#F06292', '#AED581', '#7986CB', '#4DB6AC', '#FFD54F']
  const hash = category.split('').reduce((acc, char) => char.charCodeAt(0) + acc, 0)
  return colors[hash % colors.length]
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