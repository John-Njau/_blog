import { createRouter, createWebHistory } from 'vue-router'
import PostView from '../views/posts/PostView.vue'
import PostsView from '../views/posts/PostsView.vue'
import LoginView from '../views/sessions/LoginView.vue'
import RegisterView from '../views/register/RegisterView.vue'
import NotFoundView from '../views/NotFoundView.vue'

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
      component: RegisterView
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
      component: NotFoundView
    }
  ]
})

export default router
