@props(['heading'])

<section class="px-6 py-8 max-w-4xl mx-auto">
    <h1 class="text-lg font-bold mb-8 pb-2 border-b">
        {{$heading}}
    </h1>

    <div class="flex">
        <aside class="w-48">
            <ul>
                <li><a href="/admin/posts" class="{{Request::path() === 'admin/posts' ? 'text-blue-500' : ''}}">All
                        Posts</a></li>
                <li><a href="/admin/posts/create"
                       class="{{Request::path() === 'admin/posts/create' ? 'text-blue-500' : ''}}">New Post</a></li>
<!--                <li><a href="/admin/categories"-->
<!--                       class="{{Request::path() === 'admin/categories' ? 'text-blue-500' : ''}}">Categories</a>-->
<!--                </li>-->
                <li><a href="/admin/users"
                       class="{{Request::path() === 'admin/users' ? 'text-blue-500' : ''}}">User Management</a></li>
            </ul>

        </aside>


        <main class="flex-1">
            <x-panel>

                {{$slot}}
            </x-panel>
        </main>
    </div>
</section>
