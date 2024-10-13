<template>
    <form @submit.prevent="submitForm" class="max-w-md mx-auto p-4">
      <div class="mb-4">
        <label for="name" class="block mb-2 font-medium">Nom du produit</label>
        <input
          v-model="formData.name"
          type="text"
          id="name"
          class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500"
          required
        />
      </div>
      
      <div class="grid grid-cols-2 gap-4">
        <div class="mb-4">
          <label for="price" class="block mb-2 font-medium">Prix</label>
          <input
            v-model.number="formData.price"
            type="number"
            id="price"
            step="0.01"
            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500"
            required
          />
        </div>
        
        <div class="mb-4">
          <label for="stock" class="block mb-2 font-medium">Stock</label>
          <input
            v-model.number="formData.stock"
            type="number"
            id="stock"
            min="0"
            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500"
            required
          />
        </div>
      </div>
  
      <div class="mb-4">
        <label for="category" class="block mb-2 font-medium">Catégorie</label>
        <select
          v-model="formData.categoryId"
          id="category"
          class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500"
          required
        >
          <option value="">Sélectionnez une catégorie</option>
          <option v-for="category in categories" :key="category.id" :value="category.id">
            {{ category.name }}
          </option>
        </select>
      </div>
  
      <div class="mb-4">
        <label for="supplier" class="block mb-2 font-medium">Fournisseur</label>
        <select
          v-model="formData.supplierId"
          id="supplier"
          class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500"
          required
        >
          <option value="">Sélectionnez un fournisseur</option>
          <option v-for="supplier in suppliers" :key="supplier.id" :value="supplier.id">
            {{ supplier.name }}
          </option>
        </select>
      </div>
      
      <div class="mb-4">
        <label for="sku" class="block mb-2 font-medium">Référence (SKU)</label>
        <input
          v-model="formData.sku"
          type="text"
          id="sku"
          class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500"
        />
      </div>
  
      <div class="mb-4">
        <label for="description" class="block mb-2 font-medium">Description</label>
        <textarea
          v-model="formData.description"
          id="description"
          rows="3"
          class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500"
        ></textarea>
      </div>
  
      <div class="grid grid-cols-2 gap-4">
        <div class="mb-4">
          <label for="minStock" class="block mb-2 font-medium">Stock minimum</label>
          <input
            v-model.number="formData.minStock"
            type="number"
            id="minStock"
            min="0"
            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500"
          />
        </div>
        
        <div class="mb-4">
          <label for="weight" class="block mb-2 font-medium">Poids (g)</label>
          <input
            v-model.number="formData.weight"
            type="number"
            id="weight"
            step="0.01"
            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500"
          />
        </div>
      </div>
  
      <div class="mb-4">
        <label class="block mb-2 font-medium">Statut</label>
        <div class="flex space-x-4">
          <label class="flex items-center">
            <input
              type="radio"
              v-model="formData.status"
              value="active"
              class="mr-2"
            />
            Actif
          </label>
          <label class="flex items-center">
            <input
              type="radio"
              v-model="formData.status"
              value="inactive"
              class="mr-2"
            />
            Inactif
          </label>
        </div>
      </div>
  
      <div class="mb-4">
        <label class="flex items-center">
          <input
            type="checkbox"
            v-model="formData.taxable"
            class="mr-2"
          />
          Soumis à la TVA
        </label>
      </div>
      
      <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600">
        {{ formData.id ? 'Mettre à jour' : 'Enregistrer' }} le produit
      </button>
    </form>
  </template>
  
  <script>
  export default {
    name: 'ProduitForm',
    data() {
      return {
        formData: {
          id: null, // Pour différencier création et modification
          name: '',
          price: 0,
          stock: 0,
          categoryId: '',
          supplierId: '',
          sku: '',
          description: '',
          minStock: 0,
          weight: 0,
          status: 'active',
          taxable: true
        },
        categories: [], // À remplir avec vos données de catégories
        suppliers: []   // À remplir avec vos données de fournisseurs
      }
    },
    methods: {
      submitForm() {
        // Création d'une copie des données à envoyer
        const productData = { ...this.formData }
        
        console.log('Données du produit:', productData)
        this.$emit('submit', productData)
  
        // Réinitialisation du formulaire si c'est une création
        if (!this.formData.id) {
          this.formData = {
            id: null,
            name: '',
            price: 0,
            stock: 0,
            categoryId: '',
            supplierId: '',
            sku: '',
            description: '',
            minStock: 0,
            weight: 0,
            status: 'active',
            taxable: true
          }
        }
      }
    },
    props: {
      editProduct: {
        type: Object,
        default: null
      }
    },
    watch: {
      editProduct: {
        handler(newProduct) {
          if (newProduct) {
            this.formData = { ...newProduct }
          }
        },
        immediate: true
      }
    },
    created() {
      // Ici, vous pourriez charger les catégories et fournisseurs depuis votre API
      // this.loadCategories()
      // this.loadSuppliers()
    }
  }
  </script>