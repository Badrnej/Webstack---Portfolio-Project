<template>
  <!-- <router-link to="/users" > -->
   <a href="/users" :class="['mb-3 hover:bg-orange-400 cursor-pointer inline-block p-2 rounded-lg',NavBareSection=='Users'?'bg-orange-400':'']">
     <div class="flex items-center">
       <UserIcon class="h-5 w-5 text-gray-400" />
       <span class="mx-3 text-l">Users</span>
     </div>

   </a>

 <!-- </router-link> -->
</template>

<script setup>
import { UserIcon } from 'lucide-vue-next'
const NavBareSection=sessionStorage.getItem('NavBareSection')
</script>