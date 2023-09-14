<script setup>
import axios from "axios";

import { useRoute } from "vue-router";

import CommentForm from "./CommentForm.vue";
import CommentComp from "./CommentComp.vue";
import { ref, onMounted } from "vue";

const route = useRoute();

const postComments = ref([]);
const authorName = ref("");

// fetch the post slug from the route params
const post = ref({
  slug: "",
});

const fetchPostComments = async () => {
  try {
    const response = await axios.get(
      `/api/posts/${route.params.slug}/comments`
    );
    postComments.value = response.data;
    console.log("Post Comments", postComments);
  } catch (error) {
    console.error("Error fetching post comments:", error);
  }
};

onMounted(() => {
  fetchPostComments();
});
</script>

<template>
  <section class="col-span-8 col-start-5 mt-10 space-y-6">
    <CommentForm :post="post" />
    <div v-for="comment in postComments" :key="comment.id">
      <CommentComp :comment="comment" />
    </div>
  </section>
</template>

<style lang="scss" scoped >
</style>