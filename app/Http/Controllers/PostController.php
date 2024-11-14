<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class PostController extends Controller
{
    public function create(): View|RedirectResponse
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You need to be logged in to create a post!');
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
            return redirect()->route('login')->with('error', 'You need to be logged in to create a post!');
        }

        $post = new Post();
        $post->title = $validated['title'];
        $post->content = $validated['content'];
        $post->user_id = Auth::id();
        $post->save();

        $post->categories()->attach($validated['categories']);

        return redirect()->route('main')->with('message', 'Post created successfully!');
    }

    public function show(Post $post): View
    {
        $categories = $post->categories->pluck('name');
        $comments = $post->comments()->orderBy('created_at', 'desc')->get();
        return view('components.posts.show', ['post' => $post, 'categories' => $categories, 'comments' => $comments]);
    }

    public function edit(Post $post): View|RedirectResponse
    {
        if (!Auth::user()) {
            return redirect()->route('login')->with('error', 'You need to be logged in to edit a post!');
        }

        if (Auth::id() !== $post->user_id) {
            return redirect()->route('main')->with('error', 'You can only edit your own posts!');
        }

        $categories = Category::all();

        return view('components.posts.edit', ['post' => $post, 'categories' => $categories]);
    }

    public function update(Request $request, $post): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|min:3|max:255',
            'content' => 'required|min:8',
            'categories' => 'required|array|min:1',
            'categories.*' => 'exists:categories,id',
        ]);

        if (!Auth::user()) {
            return redirect()->route('login')->with('error', 'You need to be logged in to edit a post!');
        }

        $post = Post::find($post);

        if (Auth::id() !== $post->user_id) {
            return redirect()->route('main')->with('error', 'You can only edit your own posts!');
        }

        $post->categories()->sync($validated['categories']);

        $post->title = $validated['title'];
        $post->content = $validated['content'];
        $post->save();

        return redirect()->route('posts.show', ['post' => $post])->with('message', 'Post updated successfully!');
    }

    public function destroy(Post $post): RedirectResponse
    {
        if (!Auth::user()) {
            return redirect()->route('login')->with('error', 'You need to be logged in to delete a post!');
        }

        if (Auth::id() !== $post->user_id) {
            return redirect()->route('main')->with('error', 'You can only delete your own posts!');
        }

        $post->delete();

        return redirect()->route('main')->with('message', 'Post deleted successfully!');
    }
}
