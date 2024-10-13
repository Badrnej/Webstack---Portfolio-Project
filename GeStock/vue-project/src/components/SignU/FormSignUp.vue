<script setup>
import { useStore } from 'vuex'
import { computed, reactive } from 'vue'
import { User, Mail, Lock, UserPlus } from 'lucide-vue-next'
import { RouterLink } from 'vue-router'

const store = useStore()

const user = reactive({
  nom: '',
  email: '',
  password: '',
  password_confirmation: ''
})

const errorMessage = computed(() => store.state.errorMessage)

const signup = () => {
  if (user.password !== user.password_confirmation) {
    store.commit('setErrorMessage', 'Passwords do not match')
    return
  }
  store.dispatch('signUp', user)
}
</script>

<template>
  <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-gray-100 to-gray-100 p-6">
    <div class="w-full max-w-md bg-white rounded-2xl shadow-xl overflow-hidden">
      <div class="p-8 space-y-6">
        <div class="text-center">
          <h1 class="text-3xl font-bold text-purple-700 mb-2">Create an account</h1>
          <p class="text-gray-600">Join us today and start your journey</p>
        </div>
        
        <div class="flex justify-center">
          <div class="w-24 h-24 bg-blue-100 rounded-full flex items-center justify-center">
            <UserPlus class="w-12 h-12 text-purple-500" />
          </div>
        </div>

        <form @submit.prevent="signup" class="space-y-6">
          <div>
            <label for="nom" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
            <div class="relative">
              <User class="w-5 h-5 text-gray-400 absolute left-3 top-1/2 transform -translate-y-1/2" />
              <input
                v-model="user.nom"
                type="text"
                id="nom"
                name="nom"
                class="pl-10 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                placeholder="John Doe"
                required
              >
            </div>
          </div>

          <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email address</label>
            <div class="relative">
              <Mail class="w-5 h-5 text-gray-400 absolute left-3 top-1/2 transform -translate-y-1/2" />
              <input
                v-model="user.email"
                type="email"
                id="email"
                name="email"
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
                v-model="user.password"
                type="password"
                id="password"
                name="password"
                class="pl-10 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                placeholder="••••••••"
                required
              >
            </div>
          </div>

          <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
            <div class="relative">
              <Lock class="w-5 h-5 text-gray-400 absolute left-3 top-1/2 transform -translate-y-1/2" />
              <input
                v-model="user.password_confirmation"
                type="password"
                id="password_confirmation"
                name="password_confirmation"
                class="pl-10 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                placeholder="••••••••"
                required
              >
            </div>
          </div>

          <div v-if="errorMessage" class="text-red-500 text-sm text-center">
            {{ errorMessage }}
          </div>

          <div>
            <button
              type="submit"
              class="w-full flex items-center justify-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-white bg-purple-600 hover:bg-orange-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition duration-150 ease-in-out"
            >
              <UserPlus class="w-5 h-5 mr-2" />
              Sign up
            </button>
          </div>
        </form>

        <div class="text-center">
          <p class="text-sm text-gray-600">
            Already have an account? 
            <RouterLink to="/" class="font-medium text-purple-600 hover:text-orange-500">
              Sign in
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