<template>
  <form @submit.prevent="submitForm" class="max-w-md mx-auto p-4">
    <div class="grid grid-cols-2 gap-4">
      <div class="mb-4">
        <label for="firstName" class="block mb-2 font-medium">Prénom</label>
        <input
          v-model="localFormData.firstName"
          type="text"
          id="firstName"
          class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500"
          required
        />
      </div>

      <div class="mb-4">
        <label for="lastName" class="block mb-2 font-medium">Nom</label>
        <input
          v-model="localFormData.lastName"
          type="text"
          id="lastName"
          class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500"
          required
        />
      </div>
    </div>

    <div class="mb-4">
      <label for="email" class="block mb-2 font-medium">Email</label>
      <input
        v-model="localFormData.email"
        type="email"
        id="email"
        class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500"
        required
      />
    </div>

    <div class="mb-4">
      <label for="phone" class="block mb-2 font-medium">Téléphone</label>
      <input
        v-model="localFormData.phone"
        type="tel"
        id="phone"
        class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500"
      />
    </div>

    <div class="mb-4">
      <label for="address" class="block mb-2 font-medium">Adresse</label>
      <textarea
        v-model="localFormData.address"
        id="address"
        rows="3"
        class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500"
      ></textarea>
    </div>

    <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600">
      Enregistrer le client
    </button>
  </form>
</template>

<script>
export default {
  name: 'ClientsForm',
  props: {
  formData: {
    type: Object,
    default: () => ({
      firstName: '',
      lastName: '',
      email: '',
      phone: '',
      address: '',
      siret: ''
    })
  }
},
data() {
  return {
    localFormData: { ...this.formData }
  };
},
  methods: {
    submitForm() {
      console.log('Données du client:', this.localFormData);
      this.$emit('submit', this.localFormData);
      
      // Resetting form data is handled in parent component after submission.
    }
  },
  watch: {
    formData: {
      handler(newValue) {
        this.localFormData = { ...newValue }; // Update local copy if prop changes
      },
      deep: true,
      immediate: true,
    }
  }
}
</script>

<style scoped>
/* Add any additional styles here */
</style>