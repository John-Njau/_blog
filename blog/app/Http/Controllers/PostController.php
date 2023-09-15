<?php

namespace App\Http\Controllers;

use Inertia\Inertia;


use App\Models\Post;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class PostController extends Controller
{
    //
    public function index()
    {
        $posts = Post::latest()
            ->filter(request(['search', 'category', 'author']))
            ->paginate(18)
            ->withQueryString();

        return Inertia::render('posts/index', [
            'posts' => $posts,
        ]);
    }

    public function allPosts()
    {
        $posts = Post::latest()
            ->filter(request(['search', 'category', 'author', 'comments']))
            ->paginate(18)
            ->withQueryString();

        return response()->json($posts);
    }


    public function show(Post $post)
    {
        return Inertia::render('posts/show', [
            'post' => $post,
        ]);
    }

    public function showSinglePost(Post $post)
    {
        return response()->json($post);
    }
}
