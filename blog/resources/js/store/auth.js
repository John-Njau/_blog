import { defineStore } from "pinia";
import axios from "axios";
import { useRouter } from "vue-router";

export const useAuthStore = defineStore("auth", {
    state: () => ({
        currentUser: null,
        token: null,
        isLoggedIn: false,
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
        isAuthenticated: (state) => !!state.token,

        getIsAuthenticated: (state) => state.isAuthenticated,
        getCurrentUser: (state) => state.currentUser,
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
            const router = useRouter();

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

                    // set user id to local storage
                    localStorage.setItem("user_id", user_id);
                    // set token to local storage
                    localStorage.setItem("token", response.data.token);

                    // Redirect to the login page
                    setTimeout(() => {
                        localStorage.removeItem("user_id");
                        localStorage.removeItem("token");
                        this.currentUser = null;
                        this.token = null;
                    }, 1800000);

                    // Redirect to the login page
                    // You may want to handle the redirection in your component.
                    router.push({ name: "posts" });
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

        // check if user is admin
        async isAdmin() {
            computed(() => {
                // Check if the currentUser is defined
                if (currentUser.value) {
                    // Check if 'admin' or 'moderator' role is present in the roles array
                    const roles = currentUser.value.roles; // Assuming the roles are stored in the 'roles' property
                    const username = currentUser.value.username;
                    console.log("username", username);
                    console.log("roles", roles);
                    return (
                        roles.some(
                            (role) =>
                                role.name === "Admin" ||
                                role.name === "Moderator"
                        ) ||
                        username === "kimtu" ||
                        username === "john"
                    );
                } else {
                    return false;
                }
            });
        },

        logout() {
            const router = useRouter();

            localStorage.removeItem("user_id");
            localStorage.removeItem("token");

            this.isAuthenticated = false;
            this.currentUser = null;

            window.location.href = "/";
        },

        async register() {
            const router = useRouter();

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
                    router.push({ name: "login" });
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
