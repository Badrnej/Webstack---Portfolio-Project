<template>
    <a 
      :href="href" 
      class="flex items-center space-x-3 p-3 rounded-lg text-violet-200 hover:text-white hover:bg-white/10 transition-all duration-300 ease-in-out"
      :class="{ 'bg-white/10 text-white': active }"
    >
      <div class="p-2 rounded-lg bg-violet-700/50 group-hover:bg-violet-600/50 transition-colors duration-300">
        <component :is="icon" class="w-5 h-5" />
      </div>
      <span class="font-medium">{{ label }}</span>
    </a>
  </template>
  
  <script setup>
  import { defineProps } from 'vue'
  import * as LucideIcons from 'lucide-vue-next'
  
  const props = defineProps({
    icon: {
      type: String,
      required: true
    },
    label: {
      type: String,
      required: true
    },
    href: {
      type: String,
      default: '#'
    },
    active: {
      type: Boolean,
      default: false
    }
  })
  
  const icon = LucideIcons[props.icon]
  </script>