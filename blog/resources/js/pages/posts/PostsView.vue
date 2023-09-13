<script setup>
import NavBar from "../../components/layout/NavBar.vue";
import Footer from "../../components/layout/FooterComp.vue";
import FeaturedPost from "../../components/posts/FeaturedPost.vue";

// const $route = useRoute()

// use axios to fetch posts
import axios from "axios";
import { ref, onMounted } from "vue";

const posts = ref([]);
let featuredPost = null;

// Fetch posts
const fetchPosts = async () => {
  try {
    const response = await axios.get("/api/posts");
    posts.value = response.data.data;

    if (posts.value.length > 0) {
      featuredPost = posts.value[0];

      console.log("Featured", featuredPost);
    }

    console.log(posts.value);
  } catch (error) {
    console.error("Error fetching posts:", error);
  }
};

// other posts should exclude the first post as it already in the featured card
// const otherPosts = ref([])

const categories = [
  {
    name: "Personal",
    url: "/categories/personal",
  },
  {
    name: "Business",
    url: "/categories/business",
  },
];

const selectedCategory = "";

// fetch posts on component mount
onMounted(() => {
  fetchPosts();
});

axios.defaults.baseURL = "http://127.0.0.1:8000";

fetchPosts();
console.log(posts.value);

const formatDate = (dateString) => {
  const currentDate = new Date();
  const postDate = new Date(dateString);

  const timeDifference = currentDate - postDate;
  const seconds = Math.floor(timeDifference / 1000);
  const minutes = Math.floor(seconds / 60);
  const hours = Math.floor(minutes / 60);
  const days = Math.floor(hours / 24);

  if (days > 0) {
    return `${days} day${days > 1 ? "s" : ""} ago`;
  } else if (hours > 0) {
    return `${hours} hour${hours > 1 ? "s" : ""} ago`;
  } else if (minutes > 0) {
    return `${minutes} minute${minutes > 1 ? "s" : ""} ago`;
  } else {
    return `${seconds} second${seconds !== 1 ? "s" : ""} ago`;
  }
};
</script>
<template>
  <main style="font-family: Open Sans, sans-serif">
    <section class="px-6 py-8">
      <NavBar />

      <header class="max-w-xl mx-auto mt-20 text-center">
        <h1 class="text-4xl">
          Latest <span class="text-blue-500">Laravel From Scratch</span> News
        </h1>

        <h2 class="inline-flex mt-2">
          By John Njau
          <img src="/images/lary-head.svg" alt="Head of Lary the mascot" />
        </h2>

        <p class="text-sm mt-14">
          Another year. Another update. We're refreshing the popular Laravel
          series with new content. I'm going to keep you guys up to speed with
          what's going on!
        </p>

        <div class="space-y-2 lg:space-y-0 lg:space-x-4 mt-8">
          <!--  Category -->
          <div
            class="relative flex lg:inline-flex items-center bg-gray-100 rounded-xl"
          >
            <select
              class="flex-1 appearance-none bg-transparent py-2 pl-3 pr-9 text-sm font-semibold"
              v-model="selectedCategory"
            >
              <option value="category" disabled selected>Category</option>
              <option
                v-for="category in categories"
                :key="category.name"
                :value="category.name"
              >
                {{ category.name }}
              </option>
            </select>

            <svg
              class="transform -rotate-90 absolute pointer-events-none"
              style="right: 12px"
              width="22"
              height="22"
              viewBox="0 0 22 22"
            >
              <g fill="none" fill-rule="evenodd">
                <path
                  stroke="#000"
                  stroke-opacity=".012"
                  stroke-width=".5"
                  d="M21 1v20.16H.84V1z"
                ></path>
                <path
                  fill="#222"
                  d="M13.854 7.224l-3.847 3.856 3.847 3.856-1.184 1.184-5.04-5.04 5.04-5.04z"
                ></path>
              </g>
            </svg>
          </div>

          <!-- Search -->
          <div
            class="relative flex lg:inline-flex items-center bg-gray-100 rounded-xl px-3 py-2"
          >
            <form method="GET" action="#">
              <input
                type="text"
                name="search"
                placeholder="Find something"
                class="bg-transparent placeholder-black font-semibold text-sm"
              />
            </form>
          </div>
        </div>
      </header>

      <main class="max-w-6xl mx-auto mt-6 lg:mt-20 space-y-6">
        <!-- Featured post -->
        <FeaturedPost :post="featuredPost" v-if="featuredPost" />

        <!-- other posts -->
        <div class="lg:grid lg:grid-cols-3">
          <article
            class="transition-colors duration-300 hover:bg-gray-100 border border-black border-opacity-0 hover:border-opacity-5 rounded-xl"
            v-for="post in posts"
            :key="post.id"
          >
            <div class="py-6 px-5">
              <div>
                <img
                  v-if="post.thumbnail"
                  :src="'/storage/' + post.thumbnail"
                  alt="Blog Post illustration"
                  class="rounded-xl"
                />
                <img
                  v-else
                  src="/images/illustration-3.png"
                  alt="Blog Post illustration"
                  class="rounded-xl"
                />
              </div>

              <div class="mt-8 flex flex-col justify-between">
                <header>
                  <div class="space-x-2">
                    <a
                      :href="'/?category=' + post.category.slug"
                      class="px-3 py-1 border border-blue-300 rounded-full text-blue-300 text-xs uppercase font-semibold"
                      style="font-size: 10px"
                      >{{ post.category.name }}</a
                    >
                  </div>

                  <div class="mt-4">
                    <h1 class="text-3xl">
                      {{ post.title }}
                    </h1>

                    <span class="mt-2 block text-gray-400 text-xs">
                      Published <time>{{ formatDate(post.created_at) }}</time>
                    </span>
                  </div>
                </header>

                <div class="text-sm mt-4 space-y-4" v-html="post.excerpt"></div>

                <footer class="flex justify-between items-center mt-8">
                  <div class="flex items-center text-sm">
                    <img src="/images/lary-avatar.svg" alt="Lary avatar" />
                    <div class="ml-3">
                      <h5 class="font-bold">
                        <a href="/">{{ post.author.name }}</a>
                      </h5>
                    </div>
                  </div>

                  <div>
                    <router-link
                      :to="'/posts/' + post.slug"
                      class="transition-colors duration-300 text-xs font-semibold bg-gray-200 hover:bg-gray-300 rounded-full py-2 px-8"
                    >
                      Read More
                    </router-link>
                  </div>
                </footer>
              </div>
            </div>
          </article>
        </div>
      </main>

      <Footer />
    </section>
  </main>
</template>



<style lang="scss" scoped >
</style>