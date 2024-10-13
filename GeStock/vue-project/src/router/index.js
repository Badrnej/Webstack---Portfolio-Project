import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/LoginView.vue'
import DashboardLayout from '@/components/Dashboard/DashboardLayout.vue'
import CustomersView from '@/views/CustomersView.vue'
import SuppliersView from '@/views/SuppliersView.vue'
import UsersView from '@/views/UsersView.vue'
import FactureView from '@/views/FactureView.vue'

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
      path: '/dashboard',
      name: 'dashboard',
      component: () => import('../views/DashboardView.vue')
    },
    {
      path: '/',
      component: DashboardLayout,
      children: [
        {
          path: 'customers',
          component: CustomersView,
        },
        {
          path: 'suppliers',
          component: SuppliersView,
        },
        {
          path: 'users',
          component: UsersView,
        },
        {
          path: 'factures',
          component: FactureView,
        },
        // Add more routes as needed
      ],
    },
  ]
})

export default router
