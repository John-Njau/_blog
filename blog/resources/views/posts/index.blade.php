<x-layout>
    @include('posts._header')
    <div id="app">
        <!-- Vue components will be rendered here -->
        <example-component></example-component>
        <example-counter></example-counter>

    </div>

    <main class="max-w-6xl mx-auto mt-6 lg:mt-20 space-y-6">

        @if ($posts && count($posts) > 0)
        <x-posts-grid :posts="$posts"></x-posts-grid>

        {{ $posts->links() }}
        @else
        <p class="text-center">No posts yet. Please check back later.</p>
        @endif
    </main>
</x-layout>
