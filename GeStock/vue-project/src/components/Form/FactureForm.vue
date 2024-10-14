<template>
    <form @submit.prevent="submitForm" class="max-w-2xl mx-auto p-4">
      <div class="grid grid-cols-2 gap-4">
        <div class="mb-4">
          <label for="clientId" class="block mb-2 font-medium">Client</label>
          <select
            v-model="formData.clientId"
            id="clientId"
            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-purple-700"
            required
          >
            <option value="">Sélectionnez un client</option>
            <option v-for="client in clients" :key="client.id" :value="client.id">
              {{ client.name }}
            </option>
          </select>
        </div>
        
        <div class="mb-4">
          <label for="date" class="block mb-2 font-medium">Date</label>
          <input
            v-model="formData.date"
            type="date"
            id="date"
            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-purple-700"
            required
          />
        </div>
      </div>
      
      <div class="mb-4">
        <h3 class="font-medium mb-2">Produits</h3>
        <div v-for="(item, index) in formData.items" :key="index" class="grid grid-cols-5 gap-2 mb-2">
          <select
            v-model="item.productId"
            class="col-span-2 px-3 py-2 border rounded-lg focus:outline-none focus:border-purple-700"
          >
            <option value="">Sélectionnez un produit</option>
            <option v-for="product in products" :key="product.id" :value="product.id">
              {{ product.name }}
            </option>
          </select>
          <input
            v-model.number="item.quantity"
            type="number"
            placeholder="Quantité"
            class="px-3 py-2 border rounded-lg focus:outline-none focus:border-purple-700"
          />
          <input
            v-model.number="item.price"
            type="number"
            placeholder="Prix unitaire"
            class="px-3 py-2 border rounded-lg focus:outline-none focus:border-purple-700"
          />
          <button @click="removeItem(index)" type="button" class="bg-red-500 text-white px-2 rounded-lg">
            Supprimer
          </button>
        </div>
        <button @click="addItem" type="button" class="bg-green-500 text-white px-4 py-2 rounded-lg mt-2">
          Ajouter un produit
        </button>
      </div>
      
      <div class="mb-4">
        <label for="notes" class="block mb-2 font-medium">Notes</label>
        <textarea
          v-model="formData.notes"
          id="notes"
          rows="3"
          class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-purple-700"
        ></textarea>
      </div>
      
      <div class="text-right mb-4">
        <p class="font-medium">Total : {{ calculateTotal }} €</p>
      </div>
      
      <button type="submit" class="w-full bg-purple-700 text-white py-2 rounded-lg hover:bg-orange-400">
        Générer la facture
      </button>
    </form>
  </template>
  
  <script>
  export default {
    name: 'FactureForm',
    data() {
      return {
        formData: {
          clientId: '',
          date: '',
          items: [],
          notes: ''
        },
        clients: [], // À remplir avec vos données clients
        products: [] // À remplir avec vos données produits
      }
    },
    computed: {
      calculateTotal() {
        return this.formData.items.reduce((total, item) => {
          return total + (item.quantity * item.price)
        }, 0)
      }
    },
    methods: {
      addItem() {
        this.formData.items.push({
          productId: '',
          quantity: 1,
          price: 0
        })
      },
      removeItem(index) {
        this.formData.items.splice(index, 1)
      },
      submitForm() {
        console.log('Données de la facture:', this.formData)
        this.$emit('submit', {
          ...this.formData,
          total: this.calculateTotal
        })
      }
    }
  }
  </script>