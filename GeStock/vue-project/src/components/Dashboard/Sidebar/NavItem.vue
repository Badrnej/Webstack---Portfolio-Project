<template>
    <a
      href="#"
      @click.prevent="$emit('click')"
      class="flex items-center space-x-3 px-3 py-2 rounded-lg text-violet-200 hover:text-white transition-all duration-300 ease-in-out group"
      :class="{ 'bg-violet-700/50 text-white': active }"
    >
      <div
        class="p-2 rounded-lg transition-colors duration-300"
        :class="active ? 'bg-violet-600/50' : 'bg-violet-800/50 group-hover:bg-violet-700/50'"
      >
        <component :is="icon" class="w-5 h-5" />
      </div>
      <span class="font-medium">{{ label }}</span>
    </a>
  </template>
  
  <script setup>
  import { defineProps, defineEmits } from 'vue'
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
    active: {
      type: Boolean,
      default: false
    }
  })
  
  defineEmits(['click'])
  
  const icon = LucideIcons[props.icon]
  </script>