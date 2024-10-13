<template>
    <aside class="bg-violet-500 text-white">
      <div class="p-6">
        <h1 class="text-2xl font-semibold">Dashboard</h1>
      </div>
      <nav class="mt-6">
        <AppCustomer />
        <AppSuppliers />
        <AppUsers />
        <AppFactures />
      </nav>
    </aside>
  </template>
  
  <script setup>
  import AppCustomer from './AppCustomer.vue'
import AppFactures from './AppFactures.vue';
  import AppSuppliers from './AppSuppliers.vue'
  import AppUsers from './AppUsers.vue'
  </script>

  <script>
  export default {
    name: 'AppSidebar'
  }
  </script>