import { defineStore } from "pinia";

export const usePostsStore = defineStore("posts", {
    state: () => ({
        posts: [],
        postComments: [],
        post: {},

    }),
});