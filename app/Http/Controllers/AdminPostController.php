<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Validation\Rule;

class AdminPostController extends Controller
{
    //

    public function index()
    {
        return view('admin.posts.index', [
            'posts' => Post::latest()->filter(request(['search', 'category', 'author']))->paginate(6)->withQueryString(),
        ]);
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store()
    {
//        $attributes = $this->validatePost(new Post());
//        $attributes['user_id'] = auth()->id();
//        $attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails');

        $attributes = array_merge($this->validatePost(), [
            'user_id' => auth()->id(),
            'thumbnail' => request()->file('thumbnail')->store('thumbnails'),
        ]);

        Post::create($attributes);

        return redirect('/');
    }

    public function update(Post $post)
    {

//        dd(request()->all());

        $attributes = $this->validatePost($post);

//        dd($attributes);
//        $attributes['user_id'] = auth()->id();

        if ($attributes['thumbnail'] ?? false) {
            $attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails');
        }

        $post->update($attributes);
//
        return back()->with('success', 'Post Updated!');
    }

    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }


    public function destroy(Post $post)
    {
        $post->delete();

        return back()->with('success', 'Post Deleted!');
    }

    /**
     * @param Post $post
     * @return array
     */
    protected function validatePost(?Post $post = null): array
    {
        $post ??= new Post();

        return request()->validate([
            'title' => 'required',
            'thumbnail' => $post->exists ? ['image'] : ['required', 'image'],
            'slug' => ['required', Rule::unique('posts', 'slug')->ignore($post)],
            'excerpt' => 'required',
            'body' => 'required',
            'category_id' => ['required', 'exists:categories,id'],
//            'published_at' => 'required|date',
        ]);
    }
}
