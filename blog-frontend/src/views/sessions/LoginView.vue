<script setup>
import { ref } from 'vue';
import NavBar from '../../components/NavBar.vue';
import Footer from '../../components/FooterComp.vue';

const formData = ref({
  email: '',
  password: '',
});

const formErrors = ref({
  email: '',
  password: '',
});

const csrfToken = '{{ csrf_token() }}';

const submitForm = () => {
  // Handle form submission here
  // You can access the form data in formData.value
};
</script>

<template>
    <NavBar/>
    <section class="px-6 py-8">
      <main class="max-w-lg mx-auto mt-10 bg-gray-100 border-gray-200 p-6 rounded-xl">
        <h1 class="text-center font-bold text-xl">Login!</h1>
        <form @submit.prevent="submitForm" class="mt-10">
          <input type="hidden" name="_token" :value="csrfToken" />
  
          <div class="mb-6">
            <label class="block mb-2 uppercase font-bold text-xs text-gray-700" for="email">
              Email Address
            </label>
  
            <input
              v-model="formData.email"
              type="email"
              class="border border-gray-400 p-2 w-full"
              name="email"
              id="email"
              placeholder="Your Email Address"
              required
              autocomplete="email"
            />
  
            <p class="text-red-500 text-xs mt-2" v-if="formErrors.email">{{ formErrors.email }}</p>
          </div>
  
          <div class="mb-6">
            <label class="block mb-2 uppercase font-bold text-xs text-gray-700" for="password">
              Password
            </label>
  
            <input
              v-model="formData.password"
              type="password"
              class="border border-gray-400 p-2 w-full"
              name="password"
              id="password"
              placeholder="Your Password"
              required
              autocomplete="new-password"
            />
          </div>
  
          <div class="mb-6">
            <button type="submit" class="bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-500">
              Log In
            </button>
          </div>
        </form>
      </main>
    </section>
    <Footer/>
  </template>
  

  
  <style scoped>
  /* Optional: Add scoped CSS for this component */
  </style>