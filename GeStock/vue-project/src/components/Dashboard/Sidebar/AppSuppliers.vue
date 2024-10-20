<template>
   <router-link to="/suppliers" >
    <div class="px-6 py-3 hover:bg-orange-400 cursor-pointer">
      <div class="flex items-center">
        <TruckIcon class="h-5 w-5 text-gray-400" />
        <span class="mx-3">Suppliers</span>
      </div>

    </div>

  </router-link>
</template>

<script setup>
import { TruckIcon } from 'lucide-vue-next'
</script>