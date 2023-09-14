<script setup>
import { ref, onMounted, watchEffect, computed } from "vue";

import { useRoute } from "vue-router";

import { usePostsStore } from "../../store/posts";

import CommentForm from "./CommentForm.vue";
import CommentComp from "./CommentComp.vue";

const route = useRoute();
const postsStore = usePostsStore();

onMounted(() => {
  console.log("Slug:", route.params.slug);
  postsStore.fetchPostComments(route.params.slug);
});

const post = ref({});
let postComments = ref([]);
// const postComments = computed(() => postsStore.getPostComments);


// Watch for changes in the store and update post and postComments
watchEffect(() => {
  post.value = postsStore.getPost;
  console.log("Post", post.value);
  postComments = postsStore.getPostComments;
  console.log("Post Comments", postComments.value);
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