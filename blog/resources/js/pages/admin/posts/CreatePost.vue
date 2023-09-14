<template>
    <AdminLayout :heading="pageHeading">
        <form @submit.prevent="submitForm" enctype="multipart/form-data">
            <div class="mt-6">
                <label name="category" class="block mb-2 uppercase font-bold text-xs text-gray-700" > Category </label>
                <select v-model="formData.category_id" id="category_id">
                    <option
                        v-for="category in categories"
                        :key="category.id"
                        :value="category.id"
                    >
                        {{ category.name }}
                    </option>
                </select>
                <p class="text-red-500 text-xs mt-2" name="category">

                </p>
            </div>
            <div>
                <label name="title" class="block mb-2 uppercase font-bold text-xs text-gray-700" > Title </label>
                <input v-model="formData.title" name="title" class="border border-gray-200 p-2 w-full rounded" />
                <p class="text-red-500 text-xs mt-2" name="title">

                </p>
            </div>
            <div>
                <label name="slug" class="block mb-2 uppercase font-bold text-xs text-gray-700" > Slug </label>
                <input v-model="formData.slug" name="slug" class="border border-gray-200 p-2 w-full rounded" />
                <p class="text-red-500 text-xs mt-2" name="slug">

                </p>
            </div>
            <div>
                <label  class="block mb-2 uppercase font-bold text-xs text-gray-700"> Thumbnail </label>
                <input type="file" @change="handleFileChange" name="thumbnail" class="border border-gray-200 p-2 w-full rounded" />
                <p class="text-red-500 text-xs mt-2" name="thumbnail">

                </p>
            </div>
            <div>
                <label  class="block mb-2 uppercase font-bold text-xs text-gray-700" > Excerpt </label>

                <textarea v-model="formData.excerpt" name="excerpt" class="border border-gray-200 p-2 w-full rounded" />
                <p class="text-red-500 text-xs mt-2" name="excerpt">
                </p>
            </div>
            <div>
                <label name="body" class="block mb-2 uppercase font-bold text-xs text-gray-700" > body </label>
                <textarea v-model="formData.body" name="body" class="border border-gray-200 p-2 w-full rounded" />
                <p class="text-red-500 text-xs mt-2" name="body">

                </p>
            </div>
            <button type="submit"
                    class="bg-blue-500 text-white uppercase font-semibold text-xs py-2 px-10 rounded-2xl hover:bg-blue-600"
            >
                Publish
            </button>

        </form>
    </AdminLayout>
</template>

<script setup >
import AdminLayout from "../../../components/admin/AdminLayout.vue";

import { ref } from 'vue';

const formData = ref({
    category_id: '',
    title: '',
    slug: '',
    thumbnail: null,
    excerpt: '',
    body: '',
});

const categories = ref([]);

const handleFileChange = (event) => {
    const file = event.target.files[0];
    formData.thumbnail = file;
};

const pageHeading = "Add New Post";

const submitForm = async () => {
    const formDataToSend = new FormData();
    formDataToSend.append('category_id', formData.category_id);
    formDataToSend.append('title', formData.title);
    formDataToSend.append('slug', formData.slug);
    formDataToSend.append('thumbnail', formData.thumbnail);
    formDataToSend.append('excerpt', formData.excerpt);
    formDataToSend.append('body', formData.body);

    try {
        const response = await fetch('/admin/posts', {
            method: 'POST',
            body: formDataToSend,
        });

        if (response.ok) {
            // Handle successful submission, e.g., redirect to a success page
        } else {
            // Handle error response
            const responseData = await response.json();
            console.error('Error:', responseData);
        }
    } catch (error) {
        console.error('Error submitting the form:', error);
    }
};

</script>

<style lang="scss" scoped >

</style>
