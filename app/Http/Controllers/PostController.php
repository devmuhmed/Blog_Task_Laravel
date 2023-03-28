<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Http\Requests\PostRequest;
use App\Http\Traits\Handling;

class PostController extends Controller
{
    use Handling;
    public function index()
    {
        $posts = Post::latest()->with('user', 'likes', 'comments')->paginate(6);
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('posts.create', compact('categories'));
    }
    public function store(PostRequest $request)
    {
        $validatedData = $request->validated();
        if ($request->image) {
            $validatedData['image'] = $request->image->store('posts');
        };
        $request->user()->posts()->create($validatedData);
        return redirect()->route('posts.index');
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('posts.edit', compact('post', 'categories'));
    }

    public function update(PostRequest $request, Post $post)
    {
        $validatedData = $request->validated();
        if ($request->image) {
            $validatedData['image'] = $request->image->store('posts');
        };
        $post->update($validatedData);
        return redirect()->route('posts.index');
    }

    public function destroy(Post $post)
    {
        if (!$post->user()->is(auth()->user())) {
            return redirect()->route('posts.index');
        }
        $post->delete();
        return back()->with('delete', 'deleted successfully');
    }
}
