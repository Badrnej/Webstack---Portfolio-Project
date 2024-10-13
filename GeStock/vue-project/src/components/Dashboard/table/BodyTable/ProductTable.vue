<template>
  {{ products }}
  <div class="sm:p-7 p-4">
                <div class="flex w-full items-center mb-7">
                  <button class="flex items-center gap-1  mr-3 h-8 pl-2.5 pr-2 rounded-md shadow text-gray-700 dark:text-gray-400 dark:border-gray-800 border border-gray-200 leading-none py-0">
                    <i class="fa-solid fa-table-columns"></i>
                    <select>
                      <option value="All">All</option>
                      <option value="h">f</option>
                      <option value="h">f</option>
                      <option value="h">f</option>
                      <option value="h">f</option>
                    </select>
                  </button>
                  <div class="ml-auto mr-5 text-gray-500 text-base items-center">
                    <button class="inline-flex items-center p-1 justify-center text-gray-400 rounded-md shadow hover:shadow-none border border-gray-200">
                      <i class="fa-solid fa-plus p-1"></i>
                      Add Product 
                    </button>
                  </div>
                </div>
                <table class="w-full text-left">
                  <thead>
                    <tr class="text-gray-400">
                      <th class="font-normal px-3 pt-0 pb-3 border-b border-gray-200">image</th>
                      <th class="font-normal px-3 pt-0 pb-3 border-b border-gray-200">name</th>
                      <th class="font-normal px-3 pt-0 pb-3 border-b border-gray-200">qaliti</th>
                      <th class="font-normal px-3 pt-0 pb-3 border-b border-gray-200">price</th>
                      <th class="font-normal px-3 pt-0 pb-3 border-b border-gray-200">fournisseur</th>
                      <th class="font-normal px-3 pt-0 pb-3 border-b border-gray-200">user</th>
                      <th class="font-normal px-3 pt-0 pb-3 border-b border-gray-200">actions</th>
                    </tr>
                  </thead>
                  <tbody class="text-gray-600 dark:text-gray-100">
                    <tr>
                      <td class="sm:p-3 py-2 px-1 border-b border-gray-200 dark:border-gray-800">
                        <div class="flex items-center">
                          <svg viewBox="0 0 24 24" class="w-4 mr-5 text-yellow-500" stroke="currentColor" stroke-width="3" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="12" y1="8" x2="12" y2="12"></line>
                            <line x1="12" y1="16" x2="12.01" y2="16"></line>
                          </svg>
                          Card
                        </div>
                      </td>
                      <td class="sm:p-3 py-2 px-1 border-b border-gray-200 dark:border-gray-800">
                        <div class="flex items-center">
                          PayPal
                        </div>
                      </td>
                      <td class="sm:p-3 py-2 px-1 border-b border-gray-200 dark:border-gray-800 md:table-cell hidden">Subscription renewal</td>
                      <td class="sm:p-3 py-2 px-1 border-b border-gray-200 dark:border-gray-800 text-red-500">- $120.00</td>
                      <td class="sm:p-3 py-2 px-1 border-b border-gray-200 dark:border-gray-800">
                        <div class="flex items-center">
                          <div class="sm:flex hidden flex-col">
                            24.12.2020
                            <div class="text-gray-400 text-xs">11:16 AM</div>
                          </div>
                        </div>
                      </td>
                      <td class="sm:p-3 py-2 px-1 border-b border-gray-200 dark:border-gray-800">
                        <div class="flex items-center">
                          <div class="sm:flex hidden flex-col">
                            24.12.2020
                            <div class="text-gray-400 text-xs">11:16 AM</div>
                          </div>
                        </div>
                      </td>
                      <td class="sm:p-3 py-2 px-1 border-b border-gray-200 dark:border-gray-800">
                        <div class="flex items-center gap-2">
                          <button class="p-2 px-3 bg-slate-300 shadow-lg hover:shadow-none rounded-lg">Edit</button>
                          <button class="p-2 px-3 bg-slate-300 shadow-lg hover:shadow-none rounded-lg">Delete</button>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
</template>

<script>
import { mapState, mapActions } from 'vuex';

export default {
  name: 'ProductTable',
  computed: {
    ...mapState({
      products: state => state.products
    })
  },
  methods: {
    ...mapActions(['fetchProducts']),
    editProduct(id) {
      // Implement edit functionality
      console.log('Edit product', id);
    },
    deleteProduct(id) {
      // Implement delete functionality
      console.log('Delete product', id);
    }
  },
  mounted() {
    this.fetchProducts();
  }
}
</script>