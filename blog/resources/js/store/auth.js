import { defineStore } from "pinia";
import axios from "axios";

export const useAuthStore = defineStore("auth", {
    state: () => ({
        currentUser: null,
        token: null,
        isAuthenticated: false,
        router: null,

        registerFormData: {
            name: "",
            username: "",
            email: "",
            password: "",
        },
        registerFormErrors: {
            name: "",
            username: "",
            email: "",
            password: "",
        },
        loginFormData: {
            email: "",
            password: "",
        },
        loginFormErrors: {
            email: "",
            password: "",
        },
    }),

    getters: {
        getIsAuthenticated: (state) => state.isAuthenticated,
        getCurrentUser: (state) => state.currentUser,

        isAdmin: (state) => {
            // Check if the currentUser is defined
            if (state.currentUser) {
                // Check if 'admin' or 'moderator' role is present in the roles array
                const roles = state.currentUser.roles; // Assuming the roles are stored in the 'roles' property
                const username = state.currentUser.username;

                return (
                    roles.some(
                        (role) =>
                            role.name === "Admin" || role.name === "Moderator"
                    ) ||
                    username === "kimtu" ||
                    username === "john"
                );
            } else {
                return false;
            }
        },
    },

    actions: {
        initialize() {
            const user_id = localStorage.getItem("user_id");
            if (user_id) {
                this.currentUser = user_id;
            }

            const token = localStorage.getItem("token");
            if (token) {
                this.token = token;
            }
        },
        async login() {
            try {
                // Send a POST request to login the user
                const response = await axios.post(
                    "/api/login",
                    this.loginFormData
                );

                if (response.status === 200) {
                    const user_id = response.data.user.id;
                    this.currentUser = user_id;
                    console.log("user Data", response.data.user);
                    console.log("username", response.data.user.name);
                    this.isAuthenticated = true;

                    // set user id to local storage
                    localStorage.setItem("user_id", user_id);
                    localStorage.setItem("token", response.data.token);

                    setTimeout(() => {
                        localStorage.removeItem("user_id");
                        localStorage.removeItem("token");
                        this.currentUser = null;
                        this.token = null;
                    }, 1800000);
                } else {
                    console.error(
                        "Unexpected response status:",
                        response.status
                    );
                }
            } catch (error) {
                if (error.response && error.response.data.errors) {
                    this.loginFormErrors = error.response.data.errors;
                    console.log("Errors", this.loginFormErrors);
                } else {
                    console.error("An error occurred:", error.message);
                }
            }
        },

        async getUser(user_id) {
            try {
                const response = await axios.get("/api/users/" + user_id);
                this.currentUser = response.data;
                console.log("user Data", response.data);
            } catch (error) {
                console.error("Error fetching user:", error);
            }
        },

        logout() {
            localStorage.removeItem("user_id");
            localStorage.removeItem("token");

            this.isAuthenticated = false;
            this.currentUser = null;

            window.location.href = "/";
        },

        async register() {
            // if user is authenticated, redirect to home page
            if (this.isAuthenticated) {
                router.push({ name: "posts" });
            }

            // register new user
            try {
                const response = await axios.post(
                    "/api/register",
                    this.registerFormData
                );

                if (response.status === 201) {
                    console.log(response.data);
                } else {
                    console.error(
                        "Unexpected response status:",
                        response.status
                    );
                }
            } catch (error) {
                if (error.response && error.response.data.errors) {
                    this.registerFormErrors = error.response.data.errors;
                    console.log("Errors", this.registerFormErrors);
                } else {
                    console.error("An error occurred:", error.message);
                }
            }
        },
    },
});
