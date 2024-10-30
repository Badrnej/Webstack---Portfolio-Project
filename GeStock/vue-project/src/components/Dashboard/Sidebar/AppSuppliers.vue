<template>
  <!-- <router-link to="/suppliers" > -->
   <a href="/suppliers" :class="['mb-3 hover:bg-orange-400 cursor-pointer inline-block p-2 rounded-lg',NavBareSection=='Suppliers'?'bg-orange-400':'']">
     <div class="flex items-center">
       <TruckIcon class="h-5 w-5 text-gray-400" />
       <span class="mx-3 text-l">Suppliers</span>
     </div>

   </a>

 <!-- </router-link> -->
</template>

<script setup>
import { TruckIcon } from 'lucide-vue-next'
const NavBareSection=sessionStorage.getItem('NavBareSection')
</script>