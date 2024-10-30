<template>
  <aside class="pt-14 sidebar bg-gradient-to-br from-indigo-900 via-purple-800 to-orange-400 text-white h-screen w-64 flex flex-col shadow-2xl relative overflow-hidden">
    <div class="noise-overlay"></div>
    <div class=" bg-white/10 absolute inset-0"></div>
    <div class="relative z-10 p-6">
      <h1 class="text-3xl font-extrabold flex items-center space-x-3">
        <LayoutDashboard class="w-8 h-8" />
        <span class="gradient-text">Dashboard</span>
      </h1>
    </div>
    <nav class="flex flex-col overflow-y-auto px-4 py-2 relative z-10 w-fit mx-auto">
      <AppDashboard />
      <AppCustomer />
      <AppSuppliers />
      <AppUsers />
      <AppFactures />
    </nav>
  </aside>
</template>

<script setup>

import AppDashboard from './AppDashboard.vue'
import AppCustomer from './AppCustomer.vue'
import AppSuppliers from './AppSuppliers.vue'
import AppUsers from './AppUsers.vue'
import AppFactures from './AppFactures.vue'

defineOptions({
  name: 'AppSidebar'
})
</script>

<style scoped>
.sidebar {
  --scrollbar-width: 4px;
  --scrollbar-height: 4px;
}

.noise-overlay {
  position: absolute;
  inset: 0;
  background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noiseFilter'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.65' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noiseFilter)'/%3E%3C/svg%3E");
  opacity: 0.05;
  mix-blend-mode: overlay;
  pointer-events: none;
}

.gradient-text {
  background: linear-gradient(to right, #fff, #e0e7ff);
  background-clip: text;
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}

nav {
  scrollbar-width: thin;
  scrollbar-color: rgba(255, 255, 255, 0.3) rgba(255, 255, 255, 0.1);
}

nav::-webkit-scrollbar {
  width: var(--scrollbar-width);
  height: var(--scrollbar-height);
}

nav::-webkit-scrollbar-track {
  background: rgba(255, 255, 255, 0.1);
}

nav::-webkit-scrollbar-thumb {
  background-color: rgba(255, 255, 255, 0.3);
  border-radius: calc(var(--scrollbar-width) / 2);
}

nav::-webkit-scrollbar-thumb:hover {
  background-color: rgba(255, 255, 255, 0.5);
}

.sidebar :deep(a) {
  @apply transition-all duration-300 rounded-lg hover:bg-white/10 px-3 py-2 flex items-center space-x-3;
}

.sidebar :deep(svg) {
  @apply transition-all duration-300 w-5 h-5;
}

.sidebar :deep(a:hover svg) {
  @apply transform scale-110;
}
</style>