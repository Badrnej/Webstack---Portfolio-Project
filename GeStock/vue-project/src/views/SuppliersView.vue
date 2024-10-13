<template>
  <div>
    <!-- Titre et bouton alignés sur la même ligne -->
    <div class="flex items-center justify-between mb-4">
      <h2 class="text-xl ml-4 mt-6 font-semibold">Suppliers</h2>
      <button
        @click="toggleForm"
        class="btn-add-client mt-6 mr-4 bg-purple-500 hover:bg-orange-400 text-white px-3 py-1 rounded-md text-sm flex items-center transition duration-300 ease-in-out"
      >
        <!-- Icône du bouton, change en fonction de l'état de showForm -->
       
        <!-- Texte du bouton, change en fonction de l'état de showForm -->
        {{ showForm ? 'Annuler' : 'Ajouter un fournisseur' }}
      </button>
    </div>

    <!-- Tableau des produits avec fonction supprimer -->
    <AppTable :data="fournisseurs[0]" @deleteItem="deleteProduct" />

    <FormModal :isVisible="showForm" @close="closeForm">
        <FournissurForm @submit="handleSubmit" />
      </FormModal>
  </div>
</template>

<script setup>
import AppTable from '@/components/Dashboard/table/AppTable.vue';
import FournissurForm from '@/components/Form/FournissurForm.vue';
import FormModal from '@/components/utils/Modal.vue'
import { computed, ref } from 'vue';
import { useStore } from 'vuex';
const showForm = ref(false)

const store = useStore();
const fournisseurs = computed(() => store.getters.getFournisseurs); 

// Action pour supprimer un produit
const deleteProduct = (productId) => {
  store.dispatch('deleteFournisseur', productId); // Action Vuex pour supprimer le produit
};

// Fetch data when component is mounted
store.dispatch('fetchFournisseurs');

function toggleForm() {
    showForm.value = !showForm.value
  }
  
  // Close form
  function closeForm() {
    showForm.value = false
  }
  
  // Handle form submission
  function handleSubmit(formData) {
    console.log('Submitted form data:', formData)
    // Here you would typically dispatch an action to save the facture
    store.dispatch('createFournisseur', formData)
    closeForm()
  }
</script>
