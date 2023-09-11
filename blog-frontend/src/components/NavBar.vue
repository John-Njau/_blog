<script setup>
// import { RouterLink, RouterView } from 'vue-router'
import { ref, computed } from 'vue';
import { useRoute } from 'vue-router';

const isAuthenticated = ref(false);
const currentUser = ref(null);
const route = useRoute();

const isDashboardActive = computed(() => {
  return route.path === '/admin/posts';
});

const isNewPostActive = computed(() => {
  return route.path === '/admin/posts/create';
});

const logout = () => {
  document.querySelector('#logout-form').submit();
};

// Implement authentication logic here and update isAuthenticated and currentUser accordingly.
</script>

<template>
  <nav class="md:flex md:justify-between md:items-center">
    <div>
      <a href="/">
        <img src="/images/logo.svg" alt="Laracasts Logo" width="165" height="16" />
      </a>
    </div>

    <div class="mt-8 md:mt-0 flex items-center">
      <div v-if="isAuthenticated">
        <x-dropdown>
          <x-slot name="trigger">
            <button class="text-xs font-bold uppercase">Welcome, {{ currentUser.name }}!</button>
          </x-slot>
          <x-dropdown-item href="/admin/posts" :active="isDashboardActive"
            >Dashboard</x-dropdown-item
          >
          <x-dropdown-item href="/admin/posts/create" :active="isNewPostActive"
            >New Post</x-dropdown-item
          >
          <x-dropdown-item @click.prevent="logout">Log Out</x-dropdown-item>
        </x-dropdown>

        <form id="logout-form" method="POST" action="/logout" class="ml-3">@csrf</form>
      </div>
      <div v-else>
        <a href="/register" class="text-xs font-bold uppercase">Register</a>
        <a href="/login" class="ml-3 text-xs font-bold uppercase">Log in</a>
      </div>
      <a
        href="#newsletter"
        class="bg-blue-500 ml-3 rounded-full text-xs font-semibold text-white uppercase py-3 px-5"
      >
        Subscribe for Updates
      </a>
    </div>
    <!-- <div class="mt-8 md:mt-0">
      <a href="/" class="text-xs font-bold uppercase">Home Page</a>

      <a
        href="#"
        class="bg-blue-500 ml-3 rounded-full text-xs font-semibold text-white uppercase py-3 px-5"
      >
        Subscribe for Updates
      </a>
    </div> -->

    <!-- <div class="mt-8 md:mt-0 flex items-center">
      @auth
      <x-dropdown>
        <x-slot name="trigger">
          <button class="text-xs font-bold uppercase">Welcome, {{auth()->user()->name}}!</button>
        </x-slot>
        @can('admin')
        <x-dropdown-item href="/admin/posts" :active="request()->is('admin/dashboard')"
          >Dashboard</x-dropdown-item
        >
        <x-dropdown-item href="/admin/posts/create" :active="request()->is('admin/posts/create')"
          >New Post</x-dropdown-item
        >
        @endif
        <x-dropdown-item
          href="#"
          x-data="{}"
          @click.prevent="document.querySelector('#logout-form').submit()"
          >Log Out</x-dropdown-item
        >
      </x-dropdown>

      <form id="logout-form" method="POST" action="/logout" class="ml-3">@csrf</form>
      @endauth @guest
      <a href="/register" class="text-xs font-bold uppercase">Register</a>
      <a href="/login" class="ml-3 text-xs font-bold uppercase">Log in</a>

      @endguest<a
        href="#newsletter"
        class="bg-blue-500 ml-3 rounded-full text-xs font-semibold text-white uppercase py-3 px-5"
      >
        Subscribe for Updates
      </a>
    </div> -->
  </nav>
</template>

<style>
</style>