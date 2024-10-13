<template>
  <header class="bg-gradient-to-r from-gray-900 to-gray-800 shadow-lg">
    <div class="container mx-auto px-4 py-3">
      <div class="flex items-center justify-between">
        <!-- Left side content (assumed to be here) -->
        <div>
          <!-- Add your left side content here -->
        </div>

        <!-- Right side with profile and notifications -->
        <div class="flex items-center space-x-6">
          <button class="flex items-center text-gray-300 hover:text-white transition-colors duration-200 group">
            <div class="relative">
              <Bell class="h-5 w-5" />
              <span class="absolute -top-1 -right-1 bg-red-500 rounded-full w-3 h-3 border-2 border-gray-800 group-hover:border-gray-700 transition-colors duration-200"></span>
            </div>
            <span class="ml-2 text-sm font-medium hidden sm:inline">Notifications</span>
          </button>
          <button class="flex items-center text-gray-300 hover:text-white transition-colors duration-200">
            <div class="relative">
              <div class="w-8 h-8 rounded-full border-2 border-gray-600 bg-gray-400 flex items-center justify-center">
                <User class="h-5 w-5 text-gray-600" />
              </div>
              <span class="absolute bottom-0 right-0 bg-green-500 rounded-full w-3 h-3 border-2 border-gray-800"></span>
            </div>
            <span class="ml-2 text-sm font-medium hidden sm:inline">Profile</span>
          </button>
        </div>
      </div>
    </div>
  </header>
</template>

<script setup>
import { Bell, User } from 'lucide-vue-next'

</script>

<style scoped>
/* Add any additional styles here if needed */
</style>