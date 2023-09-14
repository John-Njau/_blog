<script setup>
import { ref, computed, onMounted } from "vue";
import { useRoute } from "vue-router";
import { useAuthStore } from "../../store/auth";

const authStore = useAuthStore();

// receive admin prop from laravel
// const { isAdmin } = defineProps(["isAdmin"]);

const dropdownVisible = ref(false);

const toggleDropdown = () => {
  dropdownVisible.value = !dropdownVisible.value;
};

// const currentUser = ref(null);
const route = useRoute();

const isDashboardActive = computed(() => {
  return route.path === "/admin/posts";
});

const isNewPostActive = computed(() => {
  return route.path === "/admin/posts/create";
});

const logout = () => {
  authStore.logout();
};

onMounted(() => {
  authStore.getUser(localStorage.getItem("user_id"));
});
</script>

<template>
  <nav class="md:flex md:justify-between md:items-center">
    <div>
      <a href="/">
        <img
          src="/images/logo.svg"
          alt="Laracasts Logo"
          width="165"
          height="16"
        />
      </a>
    </div>

    <div class="mt-8 md:mt-0 flex items-center">
      <div v-if="authStore.isAuthenticated">
        <button class="text-xs font-bold uppercase" @click="toggleDropdown">
          Welcome, {{ currentUser.name }}!
        </button>
        <div v-if="dropdownVisible" class="dropdown-down">
          <div v-if="isAdmin">
            <!-- if the user is an admin -->
            <router-link to="/admin/posts">
              <div :class="{ active: isDashboardActive }" class="link">
                Dashboard
              </div>
            </router-link>
            <router-link to="/admin/posts/create">
              <div :class="{ active: isNewPostActive }" class="link">
                New Post
              </div>
            </router-link>
            <div @click.prevent="logout" class="link">Log Out</div>
          </div>
          <div v-else>
            <!-- else -->
            <div
              @click.prevent="logout"
              class="cursor-pointer block text-left px-3 text-sm leading-6 hover:bg-blue-500 hover:text-white"
            >
              Log Out
            </div>
          </div>
        </div>
      </div>
      <div v-else>
        <a href="/register" class="text-xs font-bold uppercase link"
          >Register</a
        >
        <a href="/login" class="ml-3 text-xs font-bold uppercase link"
          >Log in</a
        >
      </div>
      <a
        href="#newsletter"
        class="bg-blue-500 ml-3 rounded-full text-xs font-semibold text-white uppercase py-3 px-5"
      >
        Subscribe for Updates
      </a>
    </div>
  </nav>
</template>

<style lang="scss" scoped >
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.3s;
}

.fade-enter,
.fade-leave-to {
  opacity: 0;
}

.dropdown-down .dropdown-item {
  position: absolute;
  top: 100%;
  left: 0;
}
</style>