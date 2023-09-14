<script setup>
import { ref } from "vue";

import { useRoute } from "vue-router";

import axios from "axios";
import { usePostsStore } from "../../store/posts";

const isAuthenticated = ref(false);
const currentUser = ref(null);
const route = useRoute();

const user_id = localStorage.getItem("user_id");
if (user_id) {
  isAuthenticated.value = true;
  currentUser.value = user_id;
} else {
  isAuthenticated.value = false;
  currentUser.value = null;
}

const post = ref({
  slug: "",
});

const formErrors = ref({
  body: "",
});

const comment = ref({
  body: "",
});

const submitComment = async () => {
  usePostsStore().addComment(route.params.slug);

  // const commentData = {
  //   body: comment.value.body,
  //   post_id: post.value.id,
  //   user_id: currentUser.value
  // }

  // try {
  //   const response = await axios.post(`/api/posts/${route.params.slug}/comments`, commentData)
  //   console.log('slug', route.params.slug)
  //   console.log(response.data)
  //   if (response.status === 200) {
  //     window.location.reload()
  //   } else {
  //     console.error('Unexpected response status:', response.status)
  //   }
  // } catch (error) {
  //   if (error.response && error.response.data.errors) {
  //     formErrors.value = error.response.data.errors
  //     console.log('Errors', formErrors.value)
  //   } else {
  //     console.error('An error occurred:', error.message)
  //   }
  // }
};
</script>

<template>
  <div>
    <form
      v-if="isAuthenticated"
      @submit.prevent="submitComment"
      class="border border-gray-200 p-6 rounded-xl"
    >
      <header class="flex items-center">
        <img
          :src="`https://i.pravatar.cc/60?u=${currentUser}`"
          width="40"
          height="40"
          class="rounded-xl"
          alt=""
        />
        <h2 class="ml-4">Want to participate?</h2>
      </header>
      <div class="mt-6">
        <textarea
          v-model="comment.body"
          name="body"
          id="body"
          class="w-full text-sm focus:outline-none focus:ring"
          rows="5"
          placeholder="Quick, think of something to say!"
          required
        ></textarea>
        <span class="text-xs text-red-500" v-if="formErrors.body">{{
          formErrors.body
        }}</span>
      </div>
      <div class="flex justify-end mt-6 pt-6 border-t border-gray-200">
        <button
          type="submit"
          class="bg-blue-500 text-white rounded-full px-5 py-2 text-sm font-semibold"
        >
          Post
        </button>
      </div>
    </form>
    <p v-else class="font-semibold">
      <router-link to="/register" class="hover:underline">Register</router-link>
      or
      <router-link to="/login" class="hover:underline">Log in</router-link> to
      leave a comment.
    </p>
  </div>
</template>
<style scoped>
</style>
