<script setup>
import NavBar from "../../components/layout/NavBar.vue";
import Footer from "../../components/layout/FooterComp.vue";
import axios from 'axios'
import { ref, onMounted, computed } from 'vue'
import { useRoute } from 'vue-router'

import PostComments from '../../components/posts/PostComments.vue'

axios.defaults.baseURL = 'http://127.0.0.1:8000/api'

const route = useRoute()
const post = ref(null)
const slug = computed(() => route.params.slug)

// Fetch post data based on the route parameter (slug)
const fetchPost = async () => {
  try {
    const response = await axios.get(`/posts/${slug.value}`)
    post.value = response.data
    console.log(post.value)
  } catch (error) {
    console.error('Error fetching post:', error)
  }
}

onMounted(() => {
  fetchPost()
})

console.log(post.value)

const formatDate = (dateString) => {
  const currentDate = new Date()
  const postDate = new Date(dateString)

  const timeDifference = currentDate - postDate
  const seconds = Math.floor(timeDifference / 1000)
  const minutes = Math.floor(seconds / 60)
  const hours = Math.floor(minutes / 60)
  const days = Math.floor(hours / 24)

  if (days > 0) {
    return `${days} day${days > 1 ? 's' : ''} ago`
  } else if (hours > 0) {
    return `${hours} hour${hours > 1 ? 's' : ''} ago`
  } else if (minutes > 0) {
    return `${minutes} minute${minutes > 1 ? 's' : ''} ago`
  } else {
    return `${seconds} second${seconds !== 1 ? 's' : ''} ago`
  }
}
</script>

<template>
  <main>
    <NavBar />
    <section class="px-6 py-8">
      <main class="max-w-6xl mx-auto mt-10 lg:mt-20 space-y-6">
        <article v-if="post" class="max-w-4xl mx-auto lg:grid lg:grid-cols-12 gap-x-10">
          <div class="col-span-4 lg:text-center lg:pt-14 mb-10">
            <img
              :src="post.thumbnail ? '' + post.thumbnail : '/images/illustration-3.png'"
              alt=""
              class="rounded-xl"
            />
            <p class="mt-4 block text-gray-400 text-xs">
              Published
              <time>{{ formatDate(post.created_at) }}</time>
            </p>
            <div class="flex items-center lg:justify-center text-sm mt-4">
              <img src="/images/lary-avatar.svg" alt="Lary avatar" />
              <div class="ml-3 text-left">
                <router-link :to="'/?author=' + post.author.username">{{
                  post.author.name
                }}</router-link>
              </div>
            </div>
          </div>

          <div class="col-span-8">
            <div class="hidden lg:flex justify-between mb-6">
              <router-link
                to="/"
                class="transition-colors duration-300 relative inline-flex items-center text-lg hover:text-blue-500"
              >
                <svg width="22" height="22" viewBox="0 0 22 22" class="mr-2">
                  <g fill="none" fill-rule="evenodd">
                    <path
                      stroke="#000"
                      stroke-opacity=".012"
                      stroke-width=".5"
                      d="M21 1v20.16H.84V1z"
                    ></path>
                    <path
                      class="fill-current"
                      d="M13.854 7.224l-3.847 3.856 3.847 3.856-1.184 1.184-5.04-5.04 5.04-5.04z"
                    ></path>
                  </g>
                </svg>
                Back to Posts
              </router-link>
              <div class="space-x-2">
                <a
                  :href="'/?category=' + post.category.slug"
                  class="px-3 py-1 border border-blue-300 rounded-full text-blue-300 text-xs uppercase font-semibold"
                  style="font-size: 10px"
                  >{{ post.category.name }}</a
                >
              </div>
            </div>

            <h1 class="font-bold text-3xl lg:text-4xl mb-10">{{ post.title }}</h1>

            <div class="space-y-4 lg:text-lg leading-loose">
              <p v-html="post.body"></p>
              <h2 class="font-bold text-lg" v-html="post.excerpt"></h2>
            </div>
          </div>

          <!-- Comments -->
          <section class="col-span-8 col-start-5 mt-10 space-y-6">
            <PostComments />
          </section>
        </article>
      </main>
    </section>

    <Footer />
  </main>
</template>
<style>
</style>

