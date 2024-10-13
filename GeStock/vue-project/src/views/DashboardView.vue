<script setup>
import AppHeader from '@/components/Dashboard/AppHeader.vue';
import Sidebar from '@/components/Dashboard/Sidebar/Sidebar.vue';
import AppTable from '@/components/Dashboard/table/AppTable.vue';
import { ref } from 'vue'
  
  const recentOrders = ref([
    { id: 1, customer: 'John Doe', total: '$120.00', status: 'Completed' },
    { id: 2, customer: 'Jane Smith', total: '$85.50', status: 'Processing' },
    { id: 3, customer: 'Bob Johnson', total: '$200.00', status: 'Shipped' },
  ])
  
  const topProducts = ref([
    { id: 1, name: 'Product A', sales: 120, revenue: '$1,200.00' },
    { id: 2, name: 'Product B', sales: 85, revenue: '$850.00' },
    { id: 3, name: 'Product C', sales: 65, revenue: '$650.00' },
  ])
  
  const customerActivity = ref([
    { id: 1, customer: 'Alice Johnson', action: 'Placed an order', date: '2023-10-01' },
    { id: 2, customer: 'Charlie Brown', action: 'Viewed product', date: '2023-10-02' },
    { id: 3, customer: 'Diana Prince', action: 'Left a review', date: '2023-10-03' },
  ])
</script>
<template>
    <div class="bg-gray-100 text-gray-600 h-screen flex overflow-hidden text-sm px-3">
        <div class="flex-grow overflow-hidden h-full flex flex-col">
            <AppHeader/>
          <div class="flex-grow flex overflow-x-hidden">
            <Sidebar/>
            
            <AppTable :data="customerActivity"/>
            <AppTable :data="topProducts"/>
            <AppTable :data="recentOrders"/>
          </div>
        </div>
      </div>
</template>