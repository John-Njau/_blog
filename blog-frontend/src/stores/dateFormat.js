import { ref } from 'vue'
import { defineStore } from 'pinia'

export const formatDate = defineStore('dateStore', () => {
  const formattedDate = ref('')

  function formatDate(dateString) {
    const currentDate = new Date()
    const postDate = new Date(dateString)

    const timeDifference = currentDate - postDate
    const seconds = Math.floor(timeDifference / 1000)
    const minutes = Math.floor(seconds / 60)
    const hours = Math.floor(minutes / 60)
    const days = Math.floor(hours / 24)

    if (days > 0) {
      formattedDate.value = `${days} day${days > 1 ? 's' : ''} ago`
    } else if (hours > 0) {
      formattedDate.value = `${hours} hour${hours > 1 ? 's' : ''} ago`
    } else if (minutes > 0) {
      formattedDate.value = `${minutes} minute${minutes > 1 ? 's' : ''} ago`
    } else {
      formattedDate.value = `${seconds} second${seconds !== 1 ? 's' : ''} ago`
    }
  }

  return {
    formattedDate,
    formatDate
  }
})
