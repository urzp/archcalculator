import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import LawEditView from '../views/LawEditView.vue'
import { isLogget, isAdmin } from '../servis/functions.js';

const routes = [
  {
    path: '/',
    name: 'home',
    component: HomeView
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
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "about" */ '../views/AboutView.vue')
  }
]

const router = createRouter({
  mode: "hash",
  history: createWebHistory(process.env.BASE_URL),
  routes
})

router.beforeEach(async (to, from) => {
  let logget = await isLogget();
  let isAdmin = false

  if( to.meta.requireAdmin&&!(logget&&isAdmin) ) return {path: '/'}
  //if(!to.meta.requireAuth&&logget) return {path: '/'}
})

export default router
