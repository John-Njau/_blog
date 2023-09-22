import { createRouter, createWebHistory } from 'vue-router'
import PostView from '../pages/posts/PostView.vue'
import PostsView from '../pages/posts/PostsView.vue'
import PostsByCategoryView from '../pages/posts/PostsByCategoryView.vue'

import NotFoundView from '../pages/NotFoundView.vue'

import RegisterView from '../pages/auth/RegisterPage.vue'
import LoginView from '../pages/auth/LoginPage.vue'

// admin routes
import AllPosts from '../pages/admin/posts/AllPosts.vue'
import CreatePost from '../pages/admin/posts/CreatePost.vue'

// TODO: remove
import TestView from '../pages/TestView.vue'
import Inertia from '../pages/Inertia.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'posts',
      component: PostsView,
      props: (route) => ({ category: route.query.category })
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
      path: '/admin/posts',
      name: 'dashboard',
      component: AllPosts
    },
    {
      path: '/admin/posts/create',
      name: 'create-post',
      component: CreatePost
    },
    {
      path: '/:pathMatch(.*)*',
      name: 'not-found',
      component: NotFoundView
    },
    {
      path: '/:category',
      name: 'posts-by-category',
      component: PostsByCategoryView,
      props: true
    },
    {
      path: '/test',
      name: 'test',
      component: TestView
    },
    {
      path: '/inertia',
      name: 'inertia',
      component: Inertia
    }
  ]
})
// router.beforeEach((to, from, next) => {
// const store = useStore();

//     if (to.matched.some((record) => record.meta.requiresAuth)) {
//         if (!localStorage.getItem("token")) {
//             next({
//                 name: "login",
//             });
//         } else {
//             next();
//         }
//     } else {
//         next();
//     }
// }
// });

export default router
