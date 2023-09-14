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
                                      <router-link :to="'/admin/posts/' + post.id + '/edit'" class="text-blue-500 hover:text-blue-600">
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

  <script setup >
import AdminLayout from "../../../components/admin/AdminLayout.vue";

import { ref, onMounted } from 'vue';
import { useRouter } from 'vue-router';
import axios from 'axios';

const posts = ref([]);
const router = useRouter();

const pageHeading = "Dashboard";


const fetchPosts = async () => {
    try {
        const response = await axios.get('/api/posts');
        posts.value = response.data.data;
    } catch (error) {
        console.error('Error fetching posts:', error);
    }
};

const deletePost = async (postId) => {
    if (confirm('Are you sure you want to delete this post?')) {
        try {
            await axios.delete(`/admin/posts/${postId}`);
            // Remove the deleted post from the local list
            posts.value = posts.value.filter((post) => post.id !== postId);
        } catch (error) {
            console.error('Error deleting post:', error);
        }
    }
};

onMounted(() => {
    fetchPosts();
});
</script>

<style lang="scss" scoped >
</style>
