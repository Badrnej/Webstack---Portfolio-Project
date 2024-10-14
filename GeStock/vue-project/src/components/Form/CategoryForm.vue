<template>
    <form @submit.prevent="submitForm" class="max-w-md mx-auto p-4">
      <div class="mb-4">
        <label for="name" class="block mb-2 font-medium">Nom de la catégorie</label>
        <input
          v-model="formData.name"
          type="text"
          id="name"
          class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-purple-700"
          required
        />
      </div>
      
      <div class="mb-4">
        <label for="description" class="block mb-2 font-medium">Description</label>
        <textarea
          v-model="formData.description"
          id="description"
          rows="3"
          class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-purple-700"
        ></textarea>
      </div>
      
      <button type="submit" class="w-full bg-purple-700 text-white py-2 rounded-lg hover:bg-orange-400">
        Enregistrer la catégorie
      </button>
    </form>
  </template>
  
  <script>
  export default {
    name: 'CategoryForm',
    data() {
      return {
        formData: {
          name: '',
          description: ''
        }
      }
    },
    methods: {
      submitForm() {
        // Ici, vous pouvez ajouter la logique pour envoyer les données au backend
        console.log('Données du formulaire:', this.formData)
        // Émettre un événement pour informer le composant parent
        this.$emit('submit', this.formData)
        // Réinitialiser le formulaire
        this.formData = {
          name: '',
          description: ''
        }
      }
    }
  }
  </script>