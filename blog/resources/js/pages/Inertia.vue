<script setup>
import Layout from './Layout.vue'
import { Head } from '@inertiajs/vue3'

const { user } = defineProps({
    user: Object,
})

const layout = Layout;
</script>

<template>
    <Layout>

        <Head title="Welcome" />
        <h1>Welcome</h1>
        <p>Hello {{ user.name }}, welcome to your first Inertia app!</p>
    </Layout>
</template>
