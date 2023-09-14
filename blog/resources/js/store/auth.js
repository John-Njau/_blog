import {defineStore} from 'pinia'

export const useAuthStore = defineStore('auth', {
    state: () => ({
        user: null,
        token: null,
        isLoggedIn: false,
        isAuthenticated: false,
    }),

    actions: {
        login(user) {
            this.user = user
            this.token = user.token
            this.isLoggedIn = true
            this.isAuthenticated = true
        }
    }
})
