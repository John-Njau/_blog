<script setup>
import NavBar from '../layout/NavBar.vue'
import FooterComp from '../layout/FooterComp.vue'
import { defineProps } from 'vue'

const props = defineProps({
  heading: String
})
</script>
<template>
  <main>
    <NavBar />
    <section class="px-6 py-8 max-w-4xl mx-auto">
      <h1 class="text-lg font-bold mb-8 pb-2 border-b">{{ heading }}</h1>

      <div class="flex">
        <aside class="w-48">
          <ul>
            <li>
              <router-link
                to="/admin/posts"
                :class="{ 'text-blue-500': $route.path === '/admin/posts' }"
                >All Posts</router-link
              >
            </li>
            <li>
              <router-link
                to="/admin/posts/create"
                :class="{
                  'text-blue-500': $route.path === '/admin/posts/create'
                }"
                >New Post</router-link
              >
            </li>
            <!-- Add more router-links as needed -->
          </ul>
        </aside>

        <main class="flex-1">
          <!-- Insert the content that was previously in x-panel here -->
          <div class="border border-gray-200 p-6 rounded-xl">
            <!-- how to use slot in vue js -->
            <!-- slot the content in admin pages here -->
            <slot />
          </div>
        </main>
      </div>
    </section>
    <FooterComp />
  </main>
</template>
