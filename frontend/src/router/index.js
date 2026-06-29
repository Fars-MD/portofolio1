import { createRouter, createWebHistory } from 'vue-router'

const routes = [
  {
    path: '/',
    name: 'Home',
    component: () => import('../views/HomePage.vue'),
  },
  {
    path: '/project/:id',
    name: 'ProjectDetail',
    component: () => import('../views/ProjectDetail.vue'),
  },
]

const router = createRouter({
  history: createWebHistory(),
  routes,
})

export default router
