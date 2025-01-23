import { global } from '@/servis/globalValues.js'
import { createRouter, createWebHistory } from 'vue-router'
import HomePage from '../pages/Home.vue'
import LawEditView from '../pages/LawEdit.vue'
import ProfileView from '../pages/Profile.vue'
import { isLogget } from '@/components/Users/servis';

const routes = [
  {
    path: '/',
    name: 'home',
    component: HomePage
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
