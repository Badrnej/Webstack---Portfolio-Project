<template>
   <router-link to="/factures" >
    <div class="px-6 py-3 hover:bg-orange-400 cursor-pointer">
      <div class="flex items-center">
        <ReceiptIcon class="h-5 w-5 text-gray-400" />
        <span class="mx-3">Factures</span>
      </div>

    </div>

  </router-link>
</template>

<script setup>
import { ReceiptIcon } from 'lucide-vue-next'
</script>