<template>
  <!-- <router-link to="/customers"> -->
    <a href="/customers" :class="['mb-3 hover:bg-orange-400 cursor-pointer inline-block p-2 rounded-lg',NavBareSection=='Customers'?'bg-orange-400':'']">
      <div class="flex items-center">
        <UserIcon class="h-5 w-5 text-gray-400" />
        <span class="mx-3 text-l">Customers</span>
      </div>
    </a>
  <!-- </router-link> -->
</template>

<script setup>
import { UserIcon } from 'lucide-vue-next'
const NavBareSection=sessionStorage.getItem('NavBareSection')
</script>