import { createRouter, createWebHistory } from 'vue-router'
import PostView from '../views/posts/PostView.vue'
import PostsView from '../views/posts/PostsView.vue'
import LoginView from '../views/sessions/LoginView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'posts',
      component: PostsView
    },
    {
      path: '/register',
      name: 'register',
      component: () => import('../views/register/RegisterView.vue')
    },
    {
      path: '/login',
      name: 'login',
      component: LoginView
    },
    {
      path: '/posts/:slug',
      name: 'post',
      component: PostView
    },
    {
      path: '/:pathMatch(.*)*',
      name: 'not-found',
      component: () => import('../views/NotFoundView.vue')
    }
  ]
})

export default router
