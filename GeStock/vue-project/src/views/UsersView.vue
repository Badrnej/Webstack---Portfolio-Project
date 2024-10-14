<template>
  <div class="bg-gray-100 min-h-screen p-6">
    <div class="max-w-7xl mx-auto">
      <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-8">
        <div class="p-6">
          <div class="flex items-center justify-between mb-6">
            <h2 class="text-3xl font-bold text-gray-800 flex items-center">
              <Users class="w-8 h-8 mr-2 text-purple-600" />
              Utilisateurs
            </h2>
            <button
              @click="toggleForm"
              class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-md text-sm flex items-center transition duration-300 ease-in-out"
            >
              <UserPlus v-if="!showForm" class="w-5 h-5 mr-2" />
              <X v-else class="w-5 h-5 mr-2" />
              {{ showForm ? 'Annuler' : 'Ajouter un utilisateur' }}
            </button>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-blue-100 p-4 rounded-lg shadow">
              <h3 class="text-lg font-semibold mb-2 text-blue-800">Total des Utilisateurs</h3>
              <p class="text-3xl font-bold text-blue-600">{{ totalUsers }}</p>
            </div>
            <div class="bg-green-100 p-4 rounded-lg shadow">
              <h3 class="text-lg font-semibold mb-2 text-green-800">Utilisateurs Actifs</h3>
              <p class="text-3xl font-bold text-green-600">{{ activeUsers }}</p>
            </div>
            <div class="bg-yellow-100 p-4 rounded-lg shadow">
              <h3 class="text-lg font-semibold mb-2 text-yellow-800">Nouveaux Utilisateurs (30j)</h3>
              <p class="text-3xl font-bold text-yellow-600">{{ newUsers }}</p>
            </div>
          </div>

          <div class="mb-8">
            <h3 class="text-xl font-semibold mb-4">Répartition des Rôles</h3>
            <div class="h-64 flex items-end">
              <div v-for="(value, role) in userRoleDistribution" :key="role" class="flex-1 flex flex-col items-center">
                <div 
                  class="w-full rounded-t transition-all duration-500 ease-in-out" 
                  :style="{ 
                    height: `${(value / Math.max(...Object.values(userRoleDistribution))) * 100}%`,
                    backgroundColor: getRoleColor(role)
                  }"
                ></div>
                <span class="text-xs mt-2">{{ role }}</span>
                <span class="text-sm font-semibold">{{ value }}</span>
              </div>
            </div>
          </div>

          <div class="mb-6">
            <div class="relative">
              <input
                v-model="searchQuery"
                type="text"
                placeholder="Rechercher des utilisateurs..."
                class="w-full px-4 py-2 border border-gray-300 rounded-md pl-10 focus:outline-none focus:ring-2 focus:ring-purple-500"
              />
              <Search class="w-5 h-5 text-gray-400 absolute left-3 top-1/2 transform -translate-y-1/2" />
            </div>
          </div>

          <AppTable 
            :data="filteredUsers" 
            :columns="tableColumns"
            @editItem="editUser"
            @deleteItem="deleteUser"
            class="w-full"
          />
        </div>
      </div>
    </div>

    <FormModal :isVisible="showForm" @close="closeForm">
      <UserForm 
        :formData="selectedUser" 
        @submit="handleSubmit" 
      />
    </FormModal>
  </div>
</template>

<script setup>
import { computed, ref, onMounted } from 'vue'
import { useStore } from 'vuex'
import { Users, UserPlus, X, Search } from 'lucide-vue-next'
import AppTable from '@/components/Dashboard/table/AppTable.vue'
import UserForm from '@/components/Form/UserForm.vue'
import FormModal from '@/components/utils/Modal.vue'

const store = useStore()
const showForm = ref(false)
const selectedUser = ref(null)
const searchQuery = ref('')

const users = computed(() => store.getters.getUsers)

const filteredUsers = computed(() => {
  return users.value.filter(user => 
    user.name.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
    user.email.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
    user.role.toLowerCase().includes(searchQuery.value.toLowerCase())
  )
})

const totalUsers = computed(() => users.value.length)
const activeUsers = computed(() => users.value.filter(user => user.status === 'Active').length)
const newUsers = computed(() => {
  const thirtyDaysAgo = new Date(Date.now() - 30 * 24 * 60 * 60 * 1000)
  return users.value.filter(user => new Date(user.createdAt) > thirtyDaysAgo).length
})

const userRoleDistribution = computed(() => {
  const distribution = {}
  users.value.forEach(user => {
    distribution[user.role] = (distribution[user.role] || 0) + 1
  })
  return distribution
})

const tableColumns = [
  { key: 'name', label: 'Nom' },
  { key: 'email', label: 'Email' },
  { key: 'role', label: 'Rôle' },
  { key: 'status', label: 'Statut' },
  { key: 'lastLogin', label: 'Dernière Connexion' },
]

onMounted(() => {
  store.dispatch('fetchUsers')
})

function toggleForm() {
  showForm.value = !showForm.value
  if (showForm.value) {
    selectedUser.value = null
  }
}

function closeForm() {
  showForm.value = false
}

function handleSubmit(formData) {
  if (selectedUser.value) {
    store.dispatch('updateUser', { ...formData, id: selectedUser.value.id })
  } else {
    store.dispatch('createUser', formData)
  }
  closeForm()
}

function editUser(user) {
  selectedUser.value = { ...user }
  showForm.value = true
}

function deleteUser(userId) {
  if (confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')) {
    store.dispatch('deleteUser', userId)
  }
}

function getRoleColor(role) {
  const colors = {
    'Admin': '#FF6B6B',
    'Manager': '#4ECDC4',
    'User': '#45B7D1',
    'Guest': '#FFA07A'
  }
  return colors[role] || '#98D8C8'
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