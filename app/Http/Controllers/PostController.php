<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class PostController extends Controller
{
    public function create()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $categories = Category::all();

        return view('components.posts.create', ['categories' => $categories]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|min:3|max:255',
            'content' => 'required|min:8',
            'categories' => 'required|array|min:1',
            'categories.*' => 'exists:categories,id',
        ]);

        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $post = new Post();
        $post->title = $validated['title'];
        $post->content = $validated['content'];
        $post->user_id = Auth::id();
        $post->save();

        $post->categories()->attach($validated['categories']);

        return redirect()->route('main');
    }

    public function show(Post $post)
    {
        $categories = $post->categories;
        $comments = $post->comments()->orderBy('created_at', 'desc')->get();
        return view('components.posts.show', ['post' => $post, 'categories' => $categories, 'comments' => $comments]);
    }

    public function edit(Post $post)
    {
        if (!Auth::user()) {
            return redirect()->route('login');
        }

        if (Auth::id() !== $post->user_id) {
            return redirect()->route('main');
        }

        $categories = Category::all();

        return view('components.posts.edit', ['post' => $post, 'categories' => $categories]);
    }

    public function update(Request $request, $post)
    {
        $validated = $request->validate([
            'title' => 'required|min:3|max:255',
            'content' => 'required|min:8',
            'categories' => 'required|array|min:1',
            'categories.*' => 'exists:categories,id',
        ]);

        if (!Auth::user()) {
            return redirect()->route('login');
        }

        $post = Post::find($post);

        if (Auth::id() !== $post->user_id) {
            return redirect()->route('main');
        }

        $post->categories()->sync($validated['categories']);

        $post->title = $validated['title'];
        $post->content = $validated['content'];
        $post->save();

        return redirect()->route('posts.show', ['post' => $post]);
    }

    public function destroy(Post $post): RedirectResponse
    {
        if (!Auth::user()) {
            return redirect()->route('login');
        }

        if (Auth::id() !== $post->user_id) {
            return redirect()->route('main');
        }

        $post->delete();

        return redirect()->route('main');
    }
}
