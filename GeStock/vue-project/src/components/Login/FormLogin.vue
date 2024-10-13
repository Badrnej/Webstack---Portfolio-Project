<script setup>
import { reactive } from 'vue'
import { useStore } from 'vuex'
import { Mail, Lock, LogIn } from 'lucide-vue-next'
import { RouterLink } from 'vue-router'

const credentials = reactive({
  email: '',
  password: ''
})

const store = useStore()

const handleLogin = () => {
  store.dispatch('login', credentials)
}
</script>

<template>
  <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-gray-100 to-gray-100 p-6">
    <div class="w-full max-w-md bg-white rounded-2xl shadow-xl overflow-hidden">
      <div class="p-8 space-y-6">
        <div class="text-center">
          <h1 class="text-3xl font-bold text-purple-700 mb-2">Welcome back</h1>
          <p class="text-gray-600">Sign in to your account</p>
        </div>
        
        <div class="flex justify-center">
          <div class="w-24 h-24 bg-blue-100 rounded-full flex items-center justify-center">
            <Lock class="w-12 h-12 text-purple-500" />
          </div>
        </div>

        <form class="space-y-6" @submit.prevent="handleLogin">
          <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email address</label>
            <div class="relative">
              <Mail class="w-5 h-5 text-gray-400 absolute left-3 top-1/2 transform -translate-y-1/2" />
              <input
                v-model="credentials.email"
                type="email"
                id="email"
                class="pl-10 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                placeholder="you@example.com"
                required
              >
            </div>
          </div>
          
          <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
            <div class="relative">
              <Lock class="w-5 h-5 text-gray-400 absolute left-3 top-1/2 transform -translate-y-1/2" />
              <input
                v-model="credentials.password"
                type="password"
                id="password"
                class="pl-10 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                placeholder="••••••••"
                required
              >
            </div>
          </div>

          <div>
            <button
              type="submit"
              class="w-full flex items-center justify-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-white bg-purple-600 hover:bg-orange-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition duration-150 ease-in-out"
            >
              <LogIn class="w-5 h-5 mr-2" />
              Sign in
            </button>
          </div>
        </form>

        <div class="text-center">
          <p class="text-sm text-gray-600">
            Don't have an account yet? 
            <RouterLink to="/sign-up" class="font-medium text-purple-600 hover:text-orange-400">
              Sign up
            </RouterLink>
          </p>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
/* Add any additional styles here if needed */
</style>