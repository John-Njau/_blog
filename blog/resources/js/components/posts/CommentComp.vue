<script setup  >
import { defineProps } from 'vue'

const props = defineProps({
  comment: Object,
  authorName: String
})

const formatTimestamp = (timestamp) => {
  const now = new Date()
  const createdDate = new Date(timestamp)
  const diffInMinutes = Math.floor((now - createdDate) / 60000)
  const diffInHours = Math.floor(diffInMinutes / 60)


  if (diffInMinutes < 60) {
    return `${diffInMinutes} minutes ago`
  } else if (diffInHours < 24) {
    return `${diffInHours} hours ago`
  } else {
    const options = {
      year: 'numeric',
      month: 'long',
      day: 'numeric',
      hour: 'numeric',
      minute: 'numeric',
      hour12: true
    }
    return createdDate.toLocaleDateString(undefined, options)
  }
}
</script>
<template>
  <article class="flex bg-gray-100 border border-gray-200 p-6 rounded-xl space-x-4">
    <div class="flex-shrink-0">
      <img
        :src="`https://i.pravatar.cc/60?u=${ props.comment.user_id}`"
        width="60"
        class="rounded-xl"
        alt=""
      />
    </div>
    <div>
      <header class="mb-4">
        <!-- <h3 class="font-bold">{{ props.comment.user_id }}</h3> -->
        <h3 class="font-bold">{{ authorName }}</h3>
        <p class="text-xs">
          Posted
          <time>{{ formatTimestamp(comment.created_at) }}</time>
        </p>
      </header>
      <p>{{ comment.body }}</p>
    </div>
  </article>
</template>
  