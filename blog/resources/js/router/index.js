import { createRouter, createWebHistory } from "vue-router";
import PostView from '../pages/posts/PostView.vue'
import PostsView from '../pages/posts/PostsView.vue'
import NotFoundView from '../pages/NotFoundView.vue'


import RegisterView from "../pages/auth/RegisterComponent.vue";
import LoginView from "../pages/auth/LoginComponent.vue";

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [
        {
          path: '/',
          name: 'posts',
          component: PostsView
        },
        {
            path: "/register",
            name: "register",
            component: RegisterView,
        },
        {
          path: '/login',
          name: 'login',
          component:  LoginView
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
    ],
});

export default router;
