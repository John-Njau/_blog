<template>
  <main>
    <NavBar />
    <div class="wrapper">
      <h1>404</h1>
      <p>Page not found</p>
      <button>
        <router-link to="/">Go to Home</router-link>
      </button>
    </div>
    <Footer />
  </main>
</template>

<script setup>
import NavBar from "../components/layout/NavBar.vue";
import Footer from "../components/layout/NavBar.vue";
</script>

<style>
</style>