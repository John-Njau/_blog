<script setup >
import axios from "axios";
import { useRouter } from "vue-router";

import NavBar from "../../components/layout/NavBar.vue";
import Footer from "../../components/layout/FooterComp.vue";

const formData = {
  name: "",
  username: "",
  email: "",
  password: "",
};

const formErrors = {
  name: "",
  username: "",
  email: "",
  password: "",
};

const router = useRouter();


const baseURL = `${window.location.origin}/api/register`;

// submit form
const submitForm = async () => {
  try {
    // Send a POST request to register the user
    const response = await axios.post(baseURL, formData);

    if (response.status === 201) {
      console.log(response.data);
      router.push({ name: "login" });
    } else {
      console.error("Unexpected response status:", response.status);
    }
  } catch (error) {
    if (error.response && error.response.data.errors) {
      formErrors.value = error.response.data.errors;
      console.log("Errors", formErrors.value);
    } else {
      console.error("An error occurred:", error.message);
    }
  }
};
</script>

<template>
  <main>
    <NavBar />
    <section class="px-6 py-8">
      <main
        class="max-w-lg mx-auto mt-10 bg-gray-100 border-gray-200 p-6 rounded-xl"
      >
        <h1 class="text-center font-bold text-xl">Register!</h1>
        <form @submit.prevent="submitForm" class="mt-10">
          <div class="mb-6">
            <label
              class="block mb-2 uppercase font-bold text-xs text-gray-700"
              for="name"
            >
              Name
            </label>
            <input
              v-model="formData.name"
              type="text"
              class="border border-gray-400 p-2 w-full"
              name="name"
              id="name"
              placeholder="Your Name"
              required
              autocomplete="name"
            />
            <p class="text-red-500 text-xs mt-2" v-if="formErrors.name">
              {{ formErrors.name }}
            </p>
          </div>

          <div class="mb-6">
            <label
              class="block mb-2 uppercase font-bold text-xs text-gray-700"
              for="username"
            >
              Username
            </label>
            <input
              v-model="formData.username"
              type="text"
              class="border border-gray-400 p-2 w-full"
              name="username"
              id="username"
              placeholder="Your User Name"
              required
              autocomplete="username"
            />
            <p class="text-red-500 text-xs mt-2" v-if="formErrors.username">
              {{ formErrors.username }}
            </p>
          </div>

          <div class="mb-6">
            <label
              class="block mb-2 uppercase font-bold text-xs text-gray-700"
              for="email"
            >
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
            <p class="text-red-500 text-xs mt-2" v-if="formErrors.email">
              {{ formErrors.email }}
            </p>
          </div>

          <div class="mb-6">
            <label
              class="block mb-2 uppercase font-bold text-xs text-gray-700"
              for="password"
            >
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
            <p class="text-red-500 text-xs mt-2" v-if="formErrors.password">
              {{ formErrors.password }}
            </p>
          </div>

          <div class="mb-6">
            <button
              type="submit"
              class="bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-500"
            >
              Submit
            </button>
          </div>
        </form>
      </main>
    </section>
    <Footer />
  </main>
</template>
  
 
  
  <style scoped>
</style>