<template>
    <div>
      <div class="flex items-center justify-between mb-4">
        <h2 class="text-xl ml-4 mt-6 font-semibold">Factures</h2>
  
        <button
          @click="toggleForm"
          class="btn-add-client mt-6 mr-4 bg-purple-500 hover:bg-orange-400 text-white px-3 py-1 rounded-md text-sm flex items-center transition duration-300 ease-in-out"
        >
          {{ showForm ? 'Annuler' : 'Ajouter une Facture' }}
        </button>
      </div>
  
      <!-- Display the table of client activities -->
      <AppTable :data="factures.data" />
  
      <!-- FormModal for Facture Form -->
      <FormModal :isVisible="showForm" @close="closeForm">
        <FactureForm @submit="handleSubmit" />
      </FormModal>
    </div>
  </template>
  
  <script setup>
  import { computed, ref } from 'vue'
  import { useStore } from 'vuex'
  import AppTable from '@/components/Dashboard/table/AppTable.vue'
  import FactureForm from '@/components/Form/FactureForm.vue'
  import FormModal from '@/components/utils/Modal.vue'
  
  // Access the Vuex store
  const store = useStore()
  
  // State for showing/hiding the form
  const showForm = ref(false)
  
  // Create a computed property to get factures from the state
  const factures = computed(() => store.getters.getFactures)
  
  // Fetch data when component is mounted
  store.dispatch('fetchFactures')
  
  // Toggle form visibility
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
    store.dispatch('createFacture', formData)
    closeForm()
  }
  </script>