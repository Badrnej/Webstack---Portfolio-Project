<template>
  <aside class="bg-gradient-to-b from-violet-600 to-violet-800 text-white h-screen w-64 flex flex-col shadow-xl">
    <div class="p-6">
      <h1 class="text-2xl font-bold flex items-center space-x-2">
        <LayoutDashboard class="w-6 h-6" />
        <span>Dashboard</span>
      </h1>
    </div>
    <nav class="flex-1 overflow-y-auto px-4 py-2">
      <AppDashboard />
      <AppCustomer />
      <AppSuppliers />
      <AppUsers />
      <AppFactures />
    </nav>
    <div class="p-4 border-t border-violet-700">
      <a href="#" class="flex items-center space-x-2 text-violet-200 hover:text-white transition-colors duration-200">
        <Settings class="w-5 h-5" />
        <span>Settings</span>
      </a>
    </div>
  </aside>
</template>

<script setup>
import { LayoutDashboard, Settings } from 'lucide-vue-next'
import AppDashboard from './AppDashboard.vue'
import AppCustomer from './AppCustomer.vue'
import AppSuppliers from './AppSuppliers.vue'
import AppUsers from './AppUsers.vue'
import AppFactures from './AppFactures.vue'
</script>

<style scoped>
/* Styling for scrollbar */
nav::-webkit-scrollbar {
  width: 6px;
}

nav::-webkit-scrollbar-track {
  background: rgba(255, 255, 255, 0.1);
}

nav::-webkit-scrollbar-thumb {
  background-color: rgba(255, 255, 255, 0.3);
  border-radius: 3px;
}

nav::-webkit-scrollbar-thumb:hover {
  background-color: rgba(255, 255, 255, 0.5);
}
</style>