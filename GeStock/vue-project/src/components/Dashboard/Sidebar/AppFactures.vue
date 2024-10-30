<template>
  <!-- <router-link to="/factures" > -->
   <a href="/factures" :class="['mb-3 hover:bg-orange-400 cursor-pointer inline-block p-2 rounded-lg',NavBareSection=='Facture'?'bg-orange-400':'']">
     <div class="flex items-center">
       <ReceiptIcon class="h-5 w-5 text-gray-400" />
       <span class="mx-3 text-l">Factures</span>
     </div>

   </a>

 <!-- </router-link> -->
</template>

<script setup>
import { ReceiptIcon } from 'lucide-vue-next'
const NavBareSection=sessionStorage.getItem('NavBareSection')
</script>