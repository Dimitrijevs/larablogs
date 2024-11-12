<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, $post_id)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
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

        return redirect()->route('posts.show', $post->id);
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);

        if (Auth::id() !== $comment->user_id) {
            return redirect()->route('login');
        }

        $comment->delete();

        return back();
    }
}
