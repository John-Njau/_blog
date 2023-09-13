<script setup>
import { ref } from "vue";
import { useRouter } from "vue-router";
import axios from "axios";
import NavBar from "../../components/layout/NavBar.vue";
import Footer from "../../components/layout/FooterComp.vue";

const formData = ref({
  email: "",
  password: "",
});

const formErrors = ref({
  email: "",
  password: "",
});


const baseURL = "http://127.0.0.1:8000/api";

const router = useRouter();

// submit form
const submitForm = async () => {
  try {
    // Send a POST request to register the user
    const response = await axios.post(baseURL + "/login", formData.value);

    if (response.status === 200) {
      const user_id = response.data.user.id;
      console.log("user Data", response.data.user);

      // set user id to local storage
      localStorage.setItem("user_id", user_id);

      // Redirect to the login page
      setTimeout(() => {
        localStorage.removeItem("user_id");
      }, 1800000);

      // Redirect to the login page
      router.push({ name: "posts" });
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
        <h1 class="text-center font-bold text-xl">Login!</h1>
        <form @submit.prevent="submitForm" class="mt-10">
          <input type="hidden" name="_token" />

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
          </div>

          <div class="mb-6">
            <button
              type="submit"
              class="bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-500"
            >
              Log In
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