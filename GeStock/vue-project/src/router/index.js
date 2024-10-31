import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/LoginView.vue'
import DashboardLayout from '@/components/Dashboard/DashboardLayout.vue'
import CustomersView from '@/views/CustomersView.vue'
import SuppliersView from '@/views/SuppliersView.vue'
import UsersView from '@/views/UsersView.vue'
import FactureView from '@/views/FactureView.vue'
import DashboardView from '@/views/DashboardView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView
    },
    {
      path: '/sign-up',
      name: 'sign up',
      component: () => import('../views/SignUpView.vue')
    },
    {
      path: '/',
      component: DashboardLayout,
      children: [
        {
          path: 'dashboard',
          name: 'dashboard',
          component: CustomersView
        },
        {
          path: 'customers',
          name: 'customers',
          component: CustomersView
        },
        {
          path: 'suppliers',
          name: 'suppliers',
          component: SuppliersView
        },
        {
          path: 'users',
          name: 'users',
          component: UsersView
        },
        {
          path: 'factures',
          name: 'factures',
          component: FactureView
        }
        // Add more routes as needed
      ]
    }
  ]
})

export default router
