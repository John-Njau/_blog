<script setup>
import { ref, computed, onMounted } from 'vue'

import AdminLayout from '../../../components/admin/AdminLayout.vue'

import { usePostsStore } from '../../../store/posts'
import { useAuthStore } from '../../../store/auth'

const postsStore = usePostsStore()
const authStore = useAuthStore()

const pageHeading = 'Dashboard'

onMounted(() => {
  postsStore.fetchPosts()
  postsStore.deletePost()
  authStore.login()
})

const posts = computed(() => postsStore.getPosts)
</script>
<template>
  <AdminLayout :heading="pageHeading">
    <div class="flex flex-col">
      <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
          <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
              <tbody class="bg-white divide-y divide-gray-200">
                <tr v-for="post in posts" :key="post.id">
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center">
                      <div class="text-sm font-medium text-gray-900">
                        <router-link :to="'/posts/' + post.slug">
                          {{ post.title }}
                        </router-link>
                      </div>
                    </div>
                  </td>

                  <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <router-link
                      :to="'/admin/posts/' + post.id + '/edit'"
                      class="text-blue-500 hover:text-blue-600"
                    >
                      Edit
                    </router-link>
                  </td>

                  <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <form @submit.prevent="deletePost(post.id)">
                      <button type="submit" class="text-xs text-gray-400">Delete</button>
                    </form>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </AdminLayout>
</template>

<style lang="scss" scoped></style>
