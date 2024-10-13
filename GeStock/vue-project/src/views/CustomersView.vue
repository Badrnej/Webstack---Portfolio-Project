<template>
  <div>
    <!-- Title and button on the same line -->
    <div class="flex items-center justify-between mb-4">
      <h2 class="text-xl ml-4 mt-6 font-semibold">Customers</h2>

      <button
  @click="addNewClient"
  class="btn-add-client mt-6 mr-4 bg-purple-500 hover:bg-orange-400 text-white px-3 py-1 rounded-md text-sm flex items-center transition duration-300 ease-in-out"
>
  {{ showForm ? 'Annuler' : 'Ajouter un client' }}
</button>
    </div>

    <!-- Client Activities Table -->
    <AppTable :data="customerActivity" @editItem="editClient" @deleteItem="deleteClient" />

    <!-- Modal for Client Form -->
    <FormModal :isVisible="showForm" @close="closeForm">
      <ClientsForm 
        :formData="selectedClient" 
        @submit="handleSubmit" 
      />
    </FormModal>
  </div>
</template>

<script setup>
import { computed, ref } from 'vue';
import { useStore } from 'vuex';
import AppTable from '@/components/Dashboard/table/AppTable.vue';
import ClientsForm from '@/components/Form/clientsForm.vue'; // Adjust path as necessary
import FormModal from '@/components/utils/Modal.vue'; // Adjust path as necessary

// Access the Vuex store
const store = useStore();
const showForm = ref(false);
const selectedClient = ref(null); // To hold the client data for editing

// Create a computed property to get client data from the state
const customerActivity = computed(() => {
  return store.getters.getClients; // Fetch clients from Vuex store
});

// Fetch data when component is mounted
store.dispatch('fetchClients'); // Dispatch action to fetch clients

// To

// Close form
function closeForm() {
  showForm.value = false;
}
// Add this function
function addNewClient() {
  selectedClient.value = {
    firstName: '',
    lastName: '',
    email: '',
    phone: '',
    address: '',
    siret: ''
  };
  showForm.value = true;
}



// Modify the existing editClient function
function editClient(client) {
  selectedClient.value = {
    id: client.id, // Make sure to include the id for updating
    firstName: client.name.split(' ')[0],
    lastName: client.name.split(' ')[1],
    email: client.email,
    phone: client.phone,
    address: client.address,
    siret: client.siret || ''
  };
  showForm.value = true;
}


function deleteClient(clientId) {
  // Confirm deletion with user
  const confirmDelete = confirm("Êtes-vous sûr de vouloir supprimer ce client ?");
  if (confirmDelete) {
    store.dispatch('deleteClient', clientId)
      .then(() => {
        console.log('Client deleted successfully');
        // Optionally fetch clients again or update state here
        store.dispatch('fetchClients'); // Refresh client list after deletion
      })
      .catch(error => {
        console.error('Error deleting client:', error);
      });
  }
}


// Handle form submission
async function handleSubmit(formData) {
  console.log('Submitted form data:', formData);

  if (selectedClient.value) {
    // Update existing client
    await store.dispatch('updateClient', { ...formData, id: selectedClient.value.id });
  } else {
    // Create new client
    await store.dispatch('createClient', {
      name: `${formData.firstName} ${formData.lastName}`, // Combine first and last name if needed
      email: formData.email,
      phone: formData.phone,
      address: formData.address,
      siret: formData.siret // Include SIRET if applicable
    });
  }

  closeForm(); // Close the modal after submission
}
</script>

<style scoped>
/* Add any additional styles here */
</style>