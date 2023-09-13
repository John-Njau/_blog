import { createApp } from 'vue';

// app.vue
import App from './App.vue';
import router from './router'

const app = createApp({});

app.component('vue-app', App);

app.use(router)
app.mount('#app');
