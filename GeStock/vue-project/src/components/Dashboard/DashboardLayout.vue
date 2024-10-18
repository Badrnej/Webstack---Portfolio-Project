<template>
  <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 text-gray-800 flex overflow-hidden text-sm">
    <div class="flex-grow overflow-hidden h-full flex flex-col">
      <AppHeader class="z-10" />
      <div class="flex-grow flex overflow-x-hidden">
        <Sidebar class="z-20" />
        <main class="flex-grow relative">
          <div class="absolute inset-0 bg-white/40 backdrop-blur-sm"></div>
          <div class="relative z-10 p-6 overflow-auto h-full">
            <router-view />
          </div>
        </main>
      </div>
    </div>
  </div>
</template>

<script setup>
import { onMounted } from 'vue'
import AppHeader from '@/components/Dashboard/AppHeader.vue'
import Sidebar from '@/components/Dashboard/Sidebar/Sidebar.vue'

onMounted(() => {
  document.body.classList.add('dashboard-active')
})
</script>

<style>
.dashboard-active {
  background-image: linear-gradient(to bottom right, #F9FAFB, #F3F4F6);
  background-attachment: fixed;
}

/* Subtle grid pattern overlay */
.dashboard-active::before {
  content: '';
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-image: 
    linear-gradient(to right, #00000005 1px, transparent 1px),
    linear-gradient(to bottom, #00000005 1px, transparent 1px);
  background-size: 20px 20px;
  pointer-events: none;
}

/* Custom scrollbar styles */
::-webkit-scrollbar {
  width: 6px;
  height: 6px;
}

::-webkit-scrollbar-track {
  background: rgba(0, 0, 0, 0.1);
}

::-webkit-scrollbar-thumb {
  background-color: rgba(0, 0, 0, 0.3);
  border-radius: 3px;
}

::-webkit-scrollbar-thumb:hover {
  background-color: rgba(0, 0, 0, 0.5);
}
</style>