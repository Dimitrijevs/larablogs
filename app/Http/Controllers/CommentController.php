<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, $post_id): RedirectResponse
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('message', 'You need to be logged in to comment!');
        }

        $validated = $request->validate([
            'content' => 'required|min:3|max:350',
        ]);

        $post = Post::findOrFail($post_id);

        $comment = new Comment;
        $comment->content = $validated['content'];
        $comment->user_id = Auth::id();
        $comment->post_id = $post->id;
        $comment->save();

        return redirect()->route('posts.show', $post->id)->with('message', 'Comment added!');
    }

    public function destroy($id): RedirectResponse
    {
        $comment = Comment::findOrFail($id);

        if (Auth::id() !== $comment->user_id) {
            return redirect()->route('login');
        }

        $comment->delete();

        return back()->with('message', 'Comment deleted!');
    }
}
