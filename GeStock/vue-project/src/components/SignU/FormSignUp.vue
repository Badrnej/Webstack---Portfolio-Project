<script setup>
import { useStore } from 'vuex';
import { computed } from 'vue';
import { ref } from 'vue';
const store = useStore();
const user={
  nom:'',
  email:'',
  password:'',
  password_confirmation:''
}
let errorMessag =ref(computed(() => store.state.errorMessage)) 
const sinup=()=>{
    store.dispatch('signUp',user)
}
</script>
<template>
      <div class="w-1/3 bg-white rounded-xl shadow-lg">
          <div class="p-6 space-y-4">
              <h1 class="text-2xl font-bold text-center mb-8">
                  Sign up to your account
              </h1>
              <div class="flex justify-center">
                <img class="w-20" src="./img/icons8-sign-up (1).gif" alt="">
              </div>
              <form @submit.prevent="sinup" class="space-y-4" action="#">
                  <div>
                      <label for="nom" class="block mb-2 text-sm font-medium text-gray-900"> Your name</label>
                      <input v-model="user.nom" type="text" name="nom" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg block w-full p-2.5" placeholder="name" required>
                      <span class="text-red-500 mt-1 text-sm">{{ errorMessag }}</span>
                    </div>
                  <div>
                      <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Your email</label>
                      <input v-model="user.email" type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg block w-full p-2.5" placeholder="name@company.com" required>
                  </div>
                  <div>
                      <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
                      <input v-model="user.password"  type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg block w-full p-2.5" required>
                  </div>
                  <button type="submit" class="w-full text-white bg-primary-600 hover:bg-primary-700 font-medium rounded-lg text-sm py-3 text-center bg-blue-500">Sign up</button>
                  <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                      Have an account yet? <a href="/" class="font-medium text-primary-600 hover:underline dark:text-primary-500">Sign in</a>
                  </p>
              </form>
          </div>
      </div>   
</template>