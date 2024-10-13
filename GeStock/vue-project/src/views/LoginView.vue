<script setup>
import FormLogin from '@/components/Login/FormLogin.vue';
import AppHeader from '@/components/Login/AppHeader.vue';
</script>

<template>
  <div class="bg-slate-100 w-full h-screen flex justify-evenly items-center">
    <AppHeader/>
    <img src="../components/Login/img/image2.png" alt="">
    <FormLogin/>
    <img class="mt-auto mb-5" src="../components/Login/img/image1.png" alt="">
  </div>
</template>
