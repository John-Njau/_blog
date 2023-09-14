<script setup  >
import { ref, defineProps, onMounted, computed } from "vue";
import { useDateFormatStore } from "../../store/dateFormat";
import { usePostsStore } from "../../store/posts";

const props = defineProps({
  comment: Object,
});

const dateFormatStore = useDateFormatStore();

const postsStore = usePostsStore();

const commentAuthor = ref("");

// Fetch the username when the component is mounted
onMounted(async () => {
  // console.log("user Id", props.comment.user_id);
  const author_id = props.comment.user_id;
  await postsStore.fetchCommentAuthor(author_id);
  commentAuthor.value = postsStore.getCommentAuthor;

  // console.log("Comment Author in comment comp", commentAuthor.value);
});
</script>
<template>
  <article
    class="flex bg-gray-100 border border-gray-200 p-6 rounded-xl space-x-4"
  >
    <div class="flex-shrink-0">
      <img
        :src="`https://i.pravatar.cc/60?u=${props.comment.user_id}`"
        width="60"
        class="rounded-xl"
        alt=""
      />
    </div>
    <div>
      <header class="mb-4">
        <h3 class="font-bold">{{ commentAuthor }}</h3>
        <!-- <h3 class="font-bold">{{ authorName }}</h3> -->
        <p class="text-xs">
          Posted
          <time>{{ dateFormatStore.formatDate(comment.created_at) }}</time>
        </p>
      </header>
      <p>{{ comment.body }}</p>
    </div>
  </article>
</template>
  