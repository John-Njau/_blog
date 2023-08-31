<?php

namespace App\Http\Controllers;

use App\Models\Post;

class PostController extends Controller
{
    //
    public function index()
    {
//        $posts = Post::latest();
//
//        if (request('search')) {
//            $posts->where('title', 'like', '%' . request('search') . '%')
//                ->orWhere('body', 'like', '%' . request('search') . '%');
//        }

//        inherit the getPosts() method from the Post model
//        $posts = $this->getPosts();

//        return Post::latest()->filter(
//            request(['search', 'category', 'author'])
//        )->paginate(6)->withQueryString();


        return view('posts.index', [
            'posts' => Post::latest()->filter(request(['search', 'category', 'author']))->paginate(6)->withQueryString(),
        ]);

    }

    public function show(Post $post)
    {
        return view("posts.show", [
            "post" => $post
        ]);
    }

}
