<script setup>
import { computed, ref, onMounted } from 'vue'
import { useStore } from 'vuex'
import { Users, UserPlus, ChevronDown, ChevronUp, Search } from 'lucide-vue-next'
import AppTable from '@/components/Dashboard/table/AppTable.vue'
import ClientsForm from '@/components/Form/clientsForm.vue'
import FormModal from '@/components/utils/Modal.vue'

const store = useStore()
const showForm = ref(false)
const selectedClient = ref({
    firstName: '',
    lastName: '',
    email: '',
    phone: '',
    address: '',
    siret: ''
  })
const searchQuery = ref('')
const showStats = ref(true)

const customerActivity = computed(() => {
  return store.getters.getClients.filter(client => 
    client.name.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
    client.email.toLowerCase().includes(searchQuery.value.toLowerCase())
  )
})

const customerStats = [
  { month: 'Jan', newCustomers: 5, activeCustomers: 20 },
  { month: 'Feb', newCustomers: 8, activeCustomers: 25 },
  { month: 'Mar', newCustomers: 12, activeCustomers: 30 },
  { month: 'Apr', newCustomers: 7, activeCustomers: 35 },
  { month: 'May', newCustomers: 10, activeCustomers: 40 },
  { month: 'Jun', newCustomers: 15, activeCustomers: 45 },
]

const maxNewCustomers = Math.max(...customerStats.map(stat => stat.newCustomers))
const maxActiveCustomers = Math.max(...customerStats.map(stat => stat.activeCustomers))

onMounted(() => {
  store.dispatch('fetchClients')
})

function closeForm() {
  showForm.value = false
}

function addNewClient() {
  selectedClient.value = {
    firstName: '',
    lastName: '',
    email: '',
    phone: '',
    address: '',
    siret: ''
  }
  showForm.value = true
}

function editClient(client) {
  selectedClient.value = {
    id: client.id,
    firstName: client.name.split(' ')[0],
    lastName: client.name.split(' ')[1],
    email: client.email,
    phone: client.phone,
    address: client.address,
    siret: client.siret || ''
  }
  showForm.value = true
}

function deleteClient(clientId) {
  const confirmDelete = confirm("Are you sure you want to delete this client?")
  if (confirmDelete) {
    store.dispatch('deleteClient', clientId)
      .then(() => {
        console.log('Client deleted successfully')
        store.dispatch('fetchClients')
      })
      .catch(error => {
        console.error('Error deleting client:', error)
      })
  }
}

async function handleSubmit(formData) {
  if (selectedClient.value == {
    firstName: '',
    lastName: '',
    email: '',
    phone: '',
    address: '',
    siret: ''
  }) {
    await store.dispatch('updateClient', { ...formData, id: selectedClient.value.id })
  } else {
    await store.dispatch('createClient', { ...formData })
  }
  closeForm()
}
console.log(selectedClient.value)
</script>

<template>
  <div class="bg-gray-100 min-h-screen p-6">
    <div class="max-w-7xl mx-auto">
      <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-8">
        <div class="p-6">
          <div class="flex items-center justify-between mb-6">
            <h2 class="text-3xl font-bold text-gray-800 flex items-center">
              <Users class="w-8 h-8 mr-2 text-violet-600" />
              Customers
            </h2>
            <button
              @click="addNewClient"
              class="bg-violet-600 hover:bg-violet-700 text-white px-4 py-2 rounded-md text-sm flex items-center transition duration-300 ease-in-out"
            >
              <UserPlus class="w-5 h-5 mr-2" />
              {{ showForm ? 'Cancel' : 'Add Client' }}
            </button>
          </div>

          <div class="mb-8">
            <button
              @click="showStats = !showStats"
              class="flex items-center text-gray-600 hover:text-gray-800 transition-colors duration-300"
            >
              <span class="mr-2 font-semibold">Customer Statistics</span>
              <ChevronDown v-if="!showStats" class="w-5 h-5" />
              <ChevronUp v-else class="w-5 h-5" />
            </button>
            <div v-show="showStats" class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-6">
              <div class="bg-white p-4 rounded-lg shadow">
                <h3 class="text-lg font-semibold mb-4">New Customers</h3>
                <div class="h-64 flex items-end">
                  <div v-for="stat in customerStats" :key="stat.month" class="flex-1 flex flex-col items-center">
                    <div class="w-full bg-blue-500 rounded-t" :style="{ height: `${(stat.newCustomers / maxNewCustomers) * 100}%` }"></div>
                    <span class="text-xs mt-1">{{ stat.month }}</span>
                  </div>
                </div>
              </div>
              <div class="bg-white p-4 rounded-lg shadow">
                <h3 class="text-lg font-semibold mb-4">Active Customers</h3>
                <div class="h-64 flex items-end">
                  <div v-for="stat in customerStats" :key="stat.month" class="flex-1 flex flex-col items-center">
                    <div class="w-full bg-green-500 rounded-t" :style="{ height: `${(stat.activeCustomers / maxActiveCustomers) * 100}%` }"></div>
                    <span class="text-xs mt-1">{{ stat.month }}</span>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="mb-6">
            <div class="relative">
              <input
                v-model="searchQuery"
                type="text"
                placeholder="Search clients..."
                class="w-full px-4 py-2 border border-gray-300 rounded-md pl-10 focus:outline-none focus:ring-2 focus:ring-violet-500"
              />
              <Search class="w-5 h-5 text-gray-400 absolute left-3 top-1/2 transform -translate-y-1/2" />
            </div>
          </div>

          <AppTable
            :data="customerActivity"
            @editItem="editClient"
            @deleteItem="deleteClient"
            class="w-full"
          />
        </div>
      </div>
    </div>

    <FormModal :isVisible="showForm" @close="closeForm">
      <ClientsForm 
        :formData="selectedClient" 
        @submit="handleSubmit" 
      />
    </FormModal>
  </div>
</template>

<style scoped>
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.5s ease;
}

.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}

@keyframes slideDown {
  from {
    opacity: 0;
    transform: translateY(-10px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.slide-down-enter-active {
  animation: slideDown 0.3s ease-out;
}

.slide-down-leave-active {
  animation: slideDown 0.3s ease-in reverse;
}
</style>