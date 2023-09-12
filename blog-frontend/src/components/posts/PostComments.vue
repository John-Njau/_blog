<script setup>
import axios from 'axios'

import { useRoute } from 'vue-router'

import CommentForm from './CommentForm.vue'
import CommentComp from './CommentComp.vue'
import { ref, onMounted } from 'vue'

const baseURL = 'http://127.0.0.1:8000/api'
const route = useRoute()
// posts/{post:slug}/comments

const postComments = ref([])
// const authorName = ref('')


// fetch the post slug from the route params
const post = ref({
  slug: ''
})
// ensure the comments prop is defined and is an array

const fetchPostComments = async () => {
  try {
    const response = await axios.get(baseURL + `/posts/${route.params.slug}/comments`)
    postComments.value = response.data
    console.log('Post Comments', postComments)
  } catch (error) {
    console.error('Error fetching post comments:', error)
  }
}

async function fetchUserById(userId) {
  try {
    const response = await axios.get(baseURL + `/users/${userId}`) // Replace with your API endpoint
    return response.data // Assuming the response contains user details, adjust as needed
  } catch (error) {
    console.error('Error fetching user:', error)
    return null // Return null or handle the error as needed
  }
}

onMounted(() => {
  fetchPostComments()
  fetchUserById()
})

const getAuthorName = async (userId) => {
  const user = await fetchUserById(userId)
  console.log('user', user.name);
  return user ? user.name : 'Unknown'
}

const authorName = getAuthorName()

console.log('postComments', fetchPostComments())
</script>

<template>
  <section class="col-span-8 col-start-5 mt-10 space-y-6">
    <!-- Add comment form -->
    <CommentForm :post="post" />
    <!-- Other comments -->
    <div v-for="comment in postComments" :key="comment.id">
      <CommentComp :comment="comment" :authorName="authorName"  />
    </div>
  </section>
</template>

<style lang="scss" scoped >
</style>