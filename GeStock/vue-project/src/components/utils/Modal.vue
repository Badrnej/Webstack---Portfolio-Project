<template>
    <div v-if="isVisible" class="fixed inset-0 flex items-center justify-center z-50">
      <div class="absolute inset-0 bg-black opacity-50" @click="close"></div>
      <div class="bg-white rounded-lg overflow-hidden shadow-lg z-10 w-full max-w-lg">
        <div class="p-4">
          <slot></slot>
        </div>
        <div class="flex justify-end p-4">
          <button @click="close" class="bg-red-500 text-white px-4 py-2 rounded">Fermer</button>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    name: 'FormModal',
    props: {
      isVisible: {
        type: Boolean,
        required: true
      }
    },
    methods: {
      close() {
        this.$emit('close');
      }
    }
  }
  </script>
  
  <style scoped>
  /* Add any additional styles here */
  </style>