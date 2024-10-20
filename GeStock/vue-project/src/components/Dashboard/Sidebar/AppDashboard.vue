<template>
  <router-link to="/dashboard" class="block px-6 py-3 hover:bg-orange-400 cursor-pointer">
    <div class="flex items-center">
      <HomeIcon class="h-5 w-5 text-gray-400" />
      <span class="mx-3">Dashboard</span>
    </div>
  </router-link>
</template>

<script setup>
import { HomeIcon } from 'lucide-vue-next'
</script>

