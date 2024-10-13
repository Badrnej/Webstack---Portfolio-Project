<template>
  <div>
    <!-- Affichage des données recentOrders en tant que texte -->
    {{ recentOrders }}

    <!-- Titre et bouton alignés sur la même ligne -->
    <div class="flex items-center justify-between mb-4">
      <h2 class="text-xl ml-4 mt-6 font-semibold">Users</h2>
      <button
        @click="showForm = !showForm"
        class="btn-add-client mt-6 mr-4 bg-purple-500 hover:bg-orange-400 text-white px-3 py-1 rounded-md text-sm flex items-center transition duration-300 ease-in-out"
      >
        <!-- Icône du bouton, change en fonction de l'état de showForm -->
        <UserPlusIcon v-if="!showForm" class="h-4 w-4 mr-2" />
        <XIcon v-else class="h-4 w-4 mr-2" />
        <!-- Texte du bouton, change en fonction de l'état de showForm -->
        {{ showForm ? 'Annuler' : 'Ajouter un utilisateur' }}
      </button>
    </div>

    <!-- Tableau des commandes récentes -->
    <AppTable :data="recentOrders" />
  </div>
</template>
  
  <script setup>
  import AppTable from '@/components/Dashboard/table/AppTable.vue';
import store from '@/store/store';
  import { computed} from 'vue';
  
  const recentOrders = computed(() => {
    return store.getters.getUsers; // Assuming you want to display commandes as customer activity
  });
  
  // Fetch data when component is mounted
  store.dispatch('fetchUsers'); // Dis
  </script>