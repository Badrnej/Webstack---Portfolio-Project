<script setup>
import { ref, computed } from 'vue'
import { Bar, Line } from 'vue-chartjs'
import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale, LineElement, PointElement } from 'chart.js'
import AppHeader from '@/components/Dashboard/AppHeader.vue'
import Sidebar from '@/components/Dashboard/Sidebar/SideBar.vue'
import AppTable from '@/components/Dashboard/table/AppTable.vue'
import { TrendingUp, Users, ShoppingCart, DollarSign } from 'lucide-vue-next'

ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale, LineElement, PointElement)

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

const totalRevenue = computed(() => {
  return topProducts.value.reduce((sum, product) => sum + parseFloat(product.revenue.replace('$', '').replace(',', '')), 0)
})

const totalSales = computed(() => {
  return topProducts.value.reduce((sum, product) => sum + product.sales, 0)
})

const salesData = [
  { name: 'Jan', sales: 4000 },
  { name: 'Feb', sales: 3000 },
  { name: 'Mar', sales: 5000 },
  { name: 'Apr', sales: 4500 },
  { name: 'May', sales: 6000 },
  { name: 'Jun', sales: 5500 },
]

</script>

<template>
  <div class="bg-gray-100 text-gray-800 min-h-screen flex overflow-hidden text-sm">
    <Sidebar class="w-64 flex-shrink-0" />
    
    <div class="flex-grow overflow-hidden h-full flex flex-col">
      <AppHeader class="bg-white shadow-sm z-10" />
      
      <div class="flex-grow overflow-x-hidden overflow-y-auto p-6">
        <h1 class="text-3xl font-semibold mb-6">Dashboard</h1>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
          <div class="bg-white rounded-lg shadow p-4 flex items-center">
            <div class="rounded-full bg-blue-100 p-3 mr-4">
              <TrendingUp class="w-6 h-6 text-blue-500" />
            </div>
            <div>
              <p class="text-gray-500 text-sm">Total Revenue</p>
              <p class="text-2xl font-semibold">${{ totalRevenue.toFixed(2) }}</p>
            </div>
          </div>
          
          <div class="bg-white rounded-lg shadow p-4 flex items-center">
            <div class="rounded-full bg-green-100 p-3 mr-4">
              <ShoppingCart class="w-6 h-6 text-green-500" />
            </div>
            <div>
              <p class="text-gray-500 text-sm">Total Sales</p>
              <p class="text-2xl font-semibold">{{ totalSales }}</p>
            </div>
          </div>
          
          <div class="bg-white rounded-lg shadow p-4 flex items-center">
            <div class="rounded-full bg-yellow-100 p-3 mr-4">
              <Users class="w-6 h-6 text-yellow-500" />
            </div>
            <div>
              <p class="text-gray-500 text-sm">New Customers</p>
              <p class="text-2xl font-semibold">{{ customerActivity.length }}</p>
            </div>
          </div>
          
          <div class="bg-white rounded-lg shadow p-4 flex items-center">
            <div class="rounded-full bg-purple-100 p-3 mr-4">
              <DollarSign class="w-6 h-6 text-purple-500" />
            </div>
            <div>
              <p class="text-gray-500 text-sm">Avg. Order Value</p>
              <p class="text-2xl font-semibold">${{ (totalRevenue / recentOrders.length).toFixed(2) }}</p>
            </div>
          </div>
        </div>
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
          <div class="bg-white rounded-lg shadow p-4">
            <h2 class="text-xl font-semibold mb-4">Sales Overview</h2>
            <ResponsiveContainer width="100%" height={300}>
              <LineChart :data="salesData">
                <CartesianGrid strokeDasharray="3 3" />
                <XAxis dataKey="name" />
                <YAxis />
                <Tooltip />
                <Legend />
                <Line type="monotone" dataKey="sales" stroke="#8884d8" />
              </LineChart>
            </ResponsiveContainer>
          </div>
          
          <div class="bg-white rounded-lg shadow p-4">
            <h2 class="text-xl font-semibold mb-4">Top Products</h2>
            <ResponsiveContainer width="100%" height={300}>
              <BarChart data={topProducts}>
                <CartesianGrid strokeDasharray="3 3" />
                <XAxis dataKey="name" />
                <YAxis />
                <Tooltip />
                <Legend />
                <Bar dataKey="sales" fill="#82ca9d" />
              </BarChart>
            </ResponsiveContainer>
          </div>
        </div>
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
          <div class="bg-white rounded-lg shadow">
            <h2 class="text-xl font-semibold p-4 border-b">Recent Orders</h2>
            <AppTable :data="recentOrders" />
          </div>
          
          <div class="bg-white rounded-lg shadow">
            <h2 class="text-xl font-semibold p-4 border-b">Customer Activity</h2>
            <AppTable :data="customerActivity" />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
/* Add any additional styles here */
</style>