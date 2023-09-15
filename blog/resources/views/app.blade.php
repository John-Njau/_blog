<!doctype html>
<html class="h-full bg-gray-100">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">
<title>Laravel From Scratch Blog</title>
<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
<script src="//unpkg.com/alpinejs" defer></script>
{{-- refererence to vue --}}
@vite(['resources/css/app.css', 'resources/js/app.js'])
@inertiaHead
</head>

<body style="font-family: Open Sans, sans-serif" class="px-6 py-8" id="app" >
        @inertia
</body>
</html>



