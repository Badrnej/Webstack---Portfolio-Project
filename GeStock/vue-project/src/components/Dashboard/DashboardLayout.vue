<template>
    <div class="bg-gray-100 text-gray-600 h-screen flex overflow-hidden text-sm px-3">
      <div class="flex-grow overflow-hidden h-full flex flex-col">
        <AppHeader />
        <div class="flex-grow flex overflow-x-hidden">
          <Sidebar />
          <div class="flex-grow">
            <router-view />
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script setup>
  import AppHeader from '@/components/Dashboard/AppHeader.vue';
  import Sidebar from '@/components/Dashboard/Sidebar/Sidebar.vue';
  </script>
  
  <style scoped>
  /* Add any additional styles here */
  </style>