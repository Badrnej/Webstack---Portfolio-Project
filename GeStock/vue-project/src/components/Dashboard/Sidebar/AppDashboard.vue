<template>
  <!-- <router-link to="/dashboard" class="block px-6 py-3 hover:bg-orange-400 cursor-pointer"> -->
    <a @click="setNavBareSection" href="/dashboard" :class="['mb-3 hover:bg-orange-400 cursor-pointer inline-block p-2 rounded-lg',NavBareSection=='Dashboard'?'bg-orange-400':'']">
      <div class="flex items-center">
        <HomeIcon class="h-5 w-5 text-gray-400" />
      <span class="mx-3 text-l">Dashboard</span>
      </div>
    </a>
  <!-- </router-link> -->
</template>

<script setup>
import { HomeIcon } from 'lucide-vue-next'

function setNavBareSection() {
  sessionStorage.setItem('NavBareSection', 'Dashboard');
}

const NavBareSection=sessionStorage.getItem('NavBareSection')
</script>

