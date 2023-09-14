import { createApp } from "vue";
import { createPinia } from "pinia";
import { useAuthStore } from "./store/auth";
import App from "./App.vue";
import router from "./router";

const pinia = createPinia();
const app = createApp({});

app.component("vue-app", App);

app.use(pinia);
app.use(router);
app.mount("#app");
