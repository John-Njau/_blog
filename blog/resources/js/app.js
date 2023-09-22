import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import { createPinia } from 'pinia'
import App from './App.vue'
import router from './router'

const pinia = createPinia()

// Create a Vue app instance
const app = createApp({
  // Root component
  render: () => h(App)
})

app.use(router)
app.use(pinia)
app.mount('#app')

// Create the Inertia.js app
createInertiaApp({
  progress: {
    color: '#29d'
  },
  resolve: (name) => require(`./Pages/${name}`).default,
  setup({ el, App, props }) {
    // Attach the Inertia.js route to global properties
    app.config.globalProperties.$route = props.route

    // Register the root Vue component as "vue-app"
    app.component('vue-app', App)

    // Mount the app
    app.mount(el)
  }
})
