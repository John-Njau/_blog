import { defineStore } from 'pinia'
import axios from 'axios'

const baseURL = 'http://127.0.0.1:8000/api'

axios.defaults.baseURL = baseURL

export const useAuthStore = defineStore('auth', {
  state: () => ({
    authUser: null,
    authErrors: [],
    authStatus: null,
    userRoles: null,
    userPermissions: null
  }),

  getters: {
    user: (state) => state.authUser,
    errors: (state) => state.authErrors,
    status: (state) => state.authStatus,
    user_roles: (state) => state.userRoles,
    user_permissions: (state) => state.userPermissions
  },
  actions: {
    async getToken() {
      await axios.get('/sanctum/csrf-cookie')
    },
    async getUser() {
      await this.getToken()
      const data = await axios.get('/api/user')
      this.authUser = data.data
      this.userRoles = data.data.roles
      this.userPermissions = data.data.permissions
    },

    async handleLogin(data) {
      this.authErrors = []
      await this.getToken()
      try {
        await axios.post('/api/login', {
          email: data.email,
          password: data.password
        })
        this.router.push('/admin/dashboard')
      } catch (error) {
        if (error.response.status === 422) {
          this.authErrors = error.response.data.errors
        }
      }
    },

    async handleRegister(data) {
      this.authErrors = []
      await this.getToken()
      try {
        await axios.post('/api/register', {
          name: data.name,
          username: data.username,
          email: data.email,
          password: data.password
        })
        this.router.push('/')
      } catch (error) {
        if (error.response.status === 422) {
          this.authErrors = error.response.data.errors
        }
      }
    },

    async handleLogout() {
      await axios.post('logout')
      this.authUser = null
      this.router.push('/')
    }
  }
})
