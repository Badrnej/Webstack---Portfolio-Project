<template>
  {{ categories }}
  <div class="sm:p-7 p-4">
                <div class="flex w-full items-center mb-7">
                  <button class="inline-flex mr-3 items-center h-8 pl-2.5 pr-2 rounded-md shadow hover:shadow-none text-gray-700 border border-gray-200 leading-none py-0">
                    <i class="fa-solid fa-plus mr-2"></i>
                    Add Category
                  </button>
                </div>
                <table class="w-full text-left">
                  <thead>
                    <tr class="text-gray-400">
                      <th class="font-normal px-3 pt-0 pb-3 border-b border-gray-200 dark:border-gray-800">Name</th>
                      <th class="font-normal px-3 pt-0 pb-3 border-b border-gray-200 dark:border-gray-800">	actions</th>
                    </tr>
                  </thead>
                  <tbody class="text-gray-600 dark:text-gray-100">
                    <tr>
                      <td class="sm:p-3 py-2 px-1 border-b border-gray-200 dark:border-gray-800">
                        <div class="flex items-center">
                          Card
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
import { mapActions, mapGetters } from 'vuex';

export default {
  name: 'CategoriesComponent',
  computed: {
    ...mapGetters(['getCategories']),
    categories() {
      return this.getCategories;
    }
  },
  methods: {
    ...mapActions(['fetchCategories']),
    addCategory() {
      // Implement add category logic
    },
    editCategory() {
      // Implement edit category logic
    },
    deleteCategory(categoryId) {
      // Implement delete category logic
      console.log(`Deleting category with ID: ${categoryId}`);
    }
  },
  created() {
    this.fetchCategories();
  }
}
</script>

