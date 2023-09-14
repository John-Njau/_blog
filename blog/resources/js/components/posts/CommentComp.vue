<script setup  >
import { ref, defineProps, onMounted } from "vue";
import { useDateFormatStore } from "../../store/dateFormat";

const props = defineProps({
  comment: Object,
  authorName: String,
});

const dateFormatStore = useDateFormatStore();

const username = ref("");

// Function to fetch the username based on user_id
const fetchUsername = async (user_id) => {
  try {
    const response = await fetch(`/api/users/${user_id}`); // Replace with your actual API endpoint
    if (response.ok) {
      const userData = await response.json();
      username.value = userData.username;
    } else {
      throw new Error("Failed to fetch username");
    }
  } catch (error) {
    console.error("Error fetching username:", error);
  }
};

// Fetch the username when the component is mounted
onMounted(() => {
  fetchUsername(props.comment.user_id);
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
        <h3 class="font-bold">{{ username }}</h3>
        <h3 class="font-bold">{{ authorName }}</h3>
        <p class="text-xs">
          Posted
          <time>{{ dateFormatStore.formatDate(comment.created_at) }}</time>
        </p>
      </header>
      <p>{{ comment.body }}</p>
    </div>
  </article>
</template>
  