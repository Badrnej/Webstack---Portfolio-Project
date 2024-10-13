<template>
    <form @submit.prevent="submitForm" class="max-w-2xl mx-auto p-4">
      <div class="grid grid-cols-2 gap-4">
        <!-- Section Client -->
        <div class="mb-4">
          <label for="clientId" class="block mb-2 font-medium">Client</label>
          <select
            v-model="formData.clientId"
            id="clientId"
            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500"
            required
          >
            <option value="">Sélectionnez un client</option>
            <option v-for="client in clients" :key="client.id" :value="client.id">
              {{ client.name }}
            </option>
          </select>
        </div>
  
        <!-- Date de commande -->
        <div class="mb-4">
          <label for="orderDate" class="block mb-2 font-medium">Date de commande</label>
          <input
            v-model="formData.orderDate"
            type="date"
            id="orderDate"
            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500"
            required
          />
        </div>
      </div>
  
      <!-- Liste des produits -->
      <div class="mb-4">
        <h3 class="font-medium mb-2">Produits commandés</h3>
        <div v-for="(item, index) in formData.items" :key="index" class="grid grid-cols-6 gap-2 mb-2">
          <select
            v-model="item.productId"
            class="col-span-2 px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500"
            @change="updatePrice(index)"
          >
            <option value="">Sélectionnez un produit</option>
            <option v-for="product in products" :key="product.id" :value="product.id">
              {{ product.name }}
            </option>
          </select>
          <input
            v-model.number="item.quantity"
            type="number"
            min="1"
            placeholder="Qté"
            class="px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500"
            @input="calculateItemTotal(index)"
          />
          <input
            v-model.number="item.price"
            type="number"
            step="0.01"
            placeholder="Prix"
            class="px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500"
            @input="calculateItemTotal(index)"
          />
          <span class="px-3 py-2 bg-gray-100 rounded-lg">{{ item.total.toFixed(2) }} €</span>
          <button 
            @click="removeItem(index)" 
            type="button" 
            class="bg-red-500 text-white px-2 rounded-lg hover:bg-red-600"
          >
            Supprimer
          </button>
        </div>
        <button 
          @click="addItem" 
          type="button" 
          class="bg-green-500 text-white px-4 py-2 rounded-lg mt-2 hover:bg-green-600"
        >
          Ajouter un produit
        </button>
      </div>
  
      <!-- Statut de la commande -->
      <div class="mb-4">
        <label for="status" class="block mb-2 font-medium">Statut de la commande</label>
        <select
          v-model="formData.status"
          id="status"
          class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500"
          required
        >
          <option value="pending">En attente</option>
          <option value="confirmed">Confirmée</option>
          <option value="shipped">Expédiée</option>
          <option value="delivered">Livrée</option>
          <option value="cancelled">Annulée</option>
        </select>
      </div>
  
      <!-- Notes -->
      <div class="mb-4">
        <label for="notes" class="block mb-2 font-medium">Notes</label>
        <textarea
          v-model="formData.notes"
          id="notes"
          rows="3"
          class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500"
        ></textarea>
      </div>
  
      <!-- Résumé des totaux -->
      <div class="bg-gray-100 p-4 rounded-lg mb-4">
        <div class="flex justify-between mb-2">
          <span>Sous-total :</span>
          <span>{{ calculateSubTotal.toFixed(2) }} €</span>
        </div>
        <div class="flex justify-between mb-2">
          <span>TVA (20%) :</span>
          <span>{{ calculateTVA.toFixed(2) }} €</span>
        </div>
        <div class="flex justify-between font-bold">
          <span>Total :</span>
          <span>{{ calculateTotal.toFixed(2) }} €</span>
        </div>
      </div>
  
      <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600">
        Enregistrer la commande
      </button>
    </form>
  </template>
  
  <script>
  export default {
    name: 'OrderForm',
    data() {
      return {
        formData: {
          clientId: '',
          orderDate: new Date().toISOString().split('T')[0],
          items: [],
          status: 'pending',
          notes: ''
        },
        clients: [], // À remplir avec vos données clients
        products: [], // À remplir avec vos données produits
      }
    },
    computed: {
      calculateSubTotal() {
        return this.formData.items.reduce((total, item) => total + item.total, 0)
      },
      calculateTVA() {
        return this.calculateSubTotal * 0.20
      },
      calculateTotal() {
        return this.calculateSubTotal + this.calculateTVA
      }
    },
    methods: {
      addItem() {
        this.formData.items.push({
          productId: '',
          quantity: 1,
          price: 0,
          total: 0
        })
      },
      removeItem(index) {
        this.formData.items.splice(index, 1)
      },
      updatePrice(index) {
        const item = this.formData.items[index]
        const product = this.products.find(p => p.id === item.productId)
        if (product) {
          item.price = product.price
          this.calculateItemTotal(index)
        }
      },
      calculateItemTotal(index) {
        const item = this.formData.items[index]
        item.total = item.quantity * item.price
      },
      submitForm() {
        const orderData = {
          ...this.formData,
          subTotal: this.calculateSubTotal,
          tva: this.calculateTVA,
          total: this.calculateTotal
        }
        console.log('Données de la commande:', orderData)
        this.$emit('submit', orderData)
      }
    },
    created() {
      this.addItem() // Ajoute une ligne de produit par défaut
    }
  }
  </script>