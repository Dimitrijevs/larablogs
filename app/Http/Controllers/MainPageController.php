<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class MainPageController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::query()->orderBy('id', 'desc');

        if ($search = $request->input('search')) {
            $query->where('title', 'like', "%{$search}%")
                ->orWhere('content', 'like', "%{$search}%");
        }

        $posts = $query->paginate(12)->appends($request->except('page'));

        return view('components.list', ['posts' => $posts]);
    }
}
