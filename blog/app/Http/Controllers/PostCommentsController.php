<?php

namespace App\Http\Controllers;

use App\Models\Post;

class PostCommentsController
{
    public function index(Post $post)
    {
//        return view('posts.show', [
//            'post' => $post
//        ]);

        return response()->json($post);
    }

    public function store(Post $post)
    {

//        add a comment to a post
//        dd(request()->all());

        request()->validate([
            'body' => 'required'
        ]);

        $post->comments()->create([
            'user_id' => request()->user()->id,
            'body' => request('body')
        ]);

        // attempt to authenticate and log in the user
//        auth()->user()->comments()->create($post);

        return back();
    }

}
