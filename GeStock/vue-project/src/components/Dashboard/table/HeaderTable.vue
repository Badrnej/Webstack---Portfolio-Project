<script setup>
import { useStore } from 'vuex';
import { ref } from 'vue';
const store = useStore();
const title=ref('Product');
const activeTab=ref('Product');
const stbody=(value)=>{
    store.commit('setbody',value);
    title.value=value;
    activeTab.value=value
}
</script>
<template>
   <div class="sm:px-7 sm:pt-7 px-4 pt-4 flex flex-col w-full border-b border-gray-200 bg-white dark:bg-gray-900 dark:text-white dark:border-gray-800 sticky top-0">
       <div class="flex w-full items-center">
           <div class="flex items-center text-3xl text-gray-900 dark:text-white">
              <img v-if="title=='Product'" src="@/assets/img/img_Product.gif" class="w-12 mr-4 rounded-full" alt="Product"/>
              <img v-if="title=='Category'" src="@/assets/img/img_Category.gif" class="w-12 mr-4 rounded-full" alt="Category"/>
              <img v-if="title=='Order'" src="@/assets/img/img_Order.gif" class="w-12 mr-4 rounded-full" alt="Order"/>
                  {{ title }}
           </div>
       </div>
       <div class="flex items-center space-x-3 sm:mt-7 mt-4">
          <a href="#" @click="stbody('Product')" :class="['px-3 pb-1.5',activeTab ==='Product'?'active' :'']">Product</a>
          <a href="#" @click="stbody('Category')" :class="['px-3 pb-1.5',activeTab ==='Category'?'active' :'']">Category</a>
          <a href="#" @click="stbody('Order')" :class="['px-3 pb-1.5 sm:block hidden',activeTab ==='Order'?'active' :'']">Order</a>
       </div>
   </div> 
</template>
<style setup>
.active{
    border-bottom: 2px solid #1A73E8;
    color: #1A73E8;
  }
</style>