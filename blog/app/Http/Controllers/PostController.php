<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class PostController extends Controller
{
    //
    public function index()
    {
//        view has been changed to response to create an api
//        return view('posts.index', [
//            'posts' => Post::latest()
//                ->filter(request(['search', 'category', 'author']))
//                ->paginate(18)
//                ->withQueryString(),
//        ]);

        $posts = Post::latest()
            ->filter(request(['search', 'category', 'author']))
            ->paginate(18)
            ->withQueryString();

        return response()->json($posts);

    }


    public function show(Post $post)
    {
//        return view("posts.show", [
//            "post" => $post
//        ]);

        return response()->json($post);
    }



}
