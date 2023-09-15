<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;
use App\Models\Post;
use Illuminate\Validation\Rule;

class AdminPostController extends Controller
{
    //

    public function index()
    {
        $posts = Post::latest()->filter(request(['search', 'category', 'author']))->paginate(6)->withQueryString();

        return Inertia::render('admin/posts/index', [
            'posts' => $posts,
        ]);
    }

    public function create()
    {
        return Inertia::render('admin/posts/create');
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

        return redirect()->route('admin.posts.index')->with('success', 'Post Created!');
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
return redirect()->back()->with('success', 'Post Updated!');

    }

    public function edit(Post $post)
    {
        return Inertia::render('admin/posts/edit', [
            'post' => $post,
        ]);
    }


    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->back()->with('success', 'Post Deleted!');
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
