<!doctype html>

<title>Laravel From Scratch Blog</title>
<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
<script src="//unpkg.com/alpinejs" defer></script>
{{-- refererence to vue --}}
@vite(['resources/css/app.css', 'resources/js/app.js'])


<style>
    html {
        scroll-behavior: smooth;
    }
    .clamp{
        display: -webkit-box;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .clamp.one-line {
        -webkit-line-clamp: 1;
    }

</style>

<body style="font-family: Open Sans, sans-serif" id="app" >
    <section class="px-6 py-8">
    <vue-app :is-admin="{{ auth()->check() && auth()->user()->can('admin') ? 'true' : 'false' }}" />
    {{-- <vue-app :is-admin="false" /> --}}
    </section>
</body>


