import { global } from '@/servis/globalValues.js'
import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import LawEditView from '../views/LawEditView.vue'
import ProfileView from '../views/ProfileView.vue'
import { isLogget } from '@/components/Users/servis';

const routes = [
  {
    path: '/',
    name: 'home',
    component: HomeView
  },
  {
    path: '/profile',
    name: 'profile',
    component: ProfileView,
    meta: {
      requireAuth: true,
    },
  },
  {
    path: '/law-edit-data',
    name: 'law_edit_data',
    component: LawEditView,
    meta: {
      requireAdmin: true,
    },
  },
  {
    path: '/about',
    name: 'about',
  }
]

const router = createRouter({
  mode: "hash",
  history: createWebHistory(process.env.BASE_URL),
  routes
})

router.beforeEach(async (to, from) => {
  let logget = await isLogget();
  let isAdmin = global.admin

  if( to.meta.requireAdmin&&!(logget&&isAdmin) ) return {path: '/'}
  if( to.meta.requireAuth&&!logget) return {path: '/'}
})

export default router
