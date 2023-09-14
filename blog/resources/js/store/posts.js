import { defineStore } from "pinia";
import axios from "axios";

export const usePostsStore = defineStore("posts", {
    state: () => ({
        posts: [],
        postComments: [],
        commentAuthor: "",
        post: {},
        featuredPost: null,
        categories: [],
        selectedCategory: "",

        commentData: {
            body: "",
            post_id: "",
            user_id: "",
        },
    }),

    getters: {
        getPosts: (state) => state.posts,
        getPost: (state) => state.post,
        getPostComments: (state) => state.postComments,
        getCommentAuthor: (state) => state.commentAuthor,
        getFeaturedPost: (state) => state.featuredPost,
        getCategories: (state) => state.categories,
        getSelectedCategory: (state) => state.selectedCategory,
    },

    actions: {
        // Fetch posts
        async fetchPosts() {
            try {
                const response = await axios.get("/api/posts");
                this.posts = response.data.data;

                if (this.posts.length > 0) {
                    this.featuredPost = this.posts[0];

                    // console.log("Featured", this.featuredPost);
                }

                // console.log(this.posts);
            } catch (error) {
                console.error("Error fetching posts:", error);
            }
        },

        // Fetch post data based on the route parameter (slug)
        async fetchPost(slug) {
            try {
                const response = await axios.get(`/api/posts/${slug}`);
                this.post = response.data;
                // console.log("This Post", this.post);
            } catch (error) {
                console.error("Error fetching post:", error);
            }
        },

        // Fetch post comments
        async fetchPostComments(slug) {
            try {
                const response = await axios.get(`/api/posts/${slug}/comments`);
                this.postComments = response.data;

                // console.log("Post Comments", this.comments);
            } catch (error) {
                console.error("Error fetching post comments:", error);
            }
        },

        // Fetch comment author
        async fetchCommentAuthor(id) {
            try {
                const response = await axios.get(`/api/users/${id}`);
                // get the author of the comment and set it to the commentAuthor variable
                this.commentAuthor = response.data.username;
                // console.log("Comment Author", this.commentAuthor);
                // console.log("Comment Author", response.data);
            } catch (error) {
                console.error("Error fetching comment author:", error);
            }
        },

        // delete a post
        async deletePost(postId) {
            try {
                await axios.delete(`/admin/posts/${postId}`);
                // Remove the deleted post from the local list
                posts.value = posts.value.filter((post) => post.id !== postId);
            } catch (error) {
                console.error("Error deleting post:", error);
            }
        },

        async addComment(slug) {
            try {
                const response = await axios.post(
                    `/api/posts/${slug}/comments`,
                    this.commentData
                );
                console.log("slug", slug);
                console.log(response.data);
                if (response.status === 200) {
                    window.location.reload();
                } else {
                    console.error(
                        "Unexpected response status:",
                        response.status
                    );
                }
            } catch (error) {
                if (error.response && error.response.data.errors) {
                    formErrors.value = error.response.data.errors;
                    console.log("Errors", formErrors.value);
                } else {
                    console.error("An error occurred:", error.message);
                }
            }
        },
    },
});
