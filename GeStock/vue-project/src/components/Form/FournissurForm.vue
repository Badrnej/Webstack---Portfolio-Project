<template>
    <form @submit.prevent="submitForm" class="max-w-md mx-auto p-4">
      
      
      <div class="grid grid-cols-2 gap-4">
        <div class="mb-4">
          <label for="nom" class="block mb-2 font-medium">Nom du contact</label>
          <input
            v-model="formData.nom"
            type="text"
            id="nom"
            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-purple-700"
          />
        </div>
        
        <div class="mb-4">
          <label for="email" class="block mb-2 font-medium">Email</label>
          <input
            v-model="formData.email"
            type="email"
            id="email"
            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-purple-700"
            required
          />
        </div>
      </div>
      
      <div class="mb-4">
        <label for="phone" class="block mb-2 font-medium">Téléphone</label>
        <input
          v-model="formData.phone"
          type="tel"
          id="phone"
          class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-purple-700"
        />
      </div>
      
      <div class="mb-4">
        <label for="address" class="block mb-2 font-medium">Adresse</label>
        <textarea
          v-model="formData.address"
          id="address"
          rows="3"
          class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-purple-700"
        ></textarea>
      </div>
      
      
      
      <button type="submit" class="w-full bg-purple-700 text-white py-2 rounded-lg hover:bg-orange-400">
        Enregistrer le fournisseur
      </button>
    </form>
  </template>
  
  <script>
  export default {
    name: 'FournisseurForm',
    data() {
      return {
        formData: {
          nom: '',
          email: '',
          phone: '',
          address: '',
        }
      }
    },
    methods: {
      submitForm() {
        console.log('Données du fournisseur:', this.formData)
        this.$emit('submit', this.formData)
        this.formData = {
          nom: '',
          email: '',
          phone: '',
          address: '',
        }
      }
    }
  }
  </script>