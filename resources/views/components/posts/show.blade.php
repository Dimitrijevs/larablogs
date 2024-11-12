@extends('layout.template')

@section('content')
    <div class="">
        <div class="mb-6">
            <div class="mb-2">
                <h1 class="text-3xl font-bold">{{ $post->title }}</h1>
                <p>{{ $post->content }}</p>
            </div>
            <div class="flex justify-between text-slate-500">
                <span class="text-sm">Posted by {{ $post->user->name }}</span>
                <span class="text-sm">{{ $post->created_at->diffForHumans() }}</span>
            </div>
        </div>

        <div class="">
            <h2 class="text-xl font-bold">Comment sections</h2>

            <div class="mb-5">
                @if (Auth::check())
                    <form action="{{ route('comments.store', $post->id) }}" method="POST">
                        @csrf
                        <div class="flex flex-col mb-2">
                            <label for="content" class="mb-1">Add a comment:</label>
                            <textarea name="content" id="content" rows="3"
                                class="border border-slate-200 p-2 rounded-lg focus:outline-red-400"></textarea>
                            @error('content')
                                <span class="text-red-400">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit"
                            class="bg-red-400 text-white py-2 px-4 rounded-lg hover:bg-red-300 hover:text-black duration-300">Post
                            Comment</button>
                    </form>
                @else
                    <p class="mt-4">Please <a href="{{ route('login') }}"
                            class="text-red-400 hover:text-red-300">login</a> to post a
                        comment.</p>
                @endif
            </div>

            <div class="mb-5">
                @foreach ($comments as $comment)
                    <div class="mb-3">
                        <p>{{ $comment->content }}</p>
                        <div class="flex justify-between text-slate-500 mb-2">
                            <div class="flex">
                                <span class="text-sm me-1">Commented by {{ $comment->user->name }}</span>
                                <span class="text-sm">({{ $comment->created_at->diffForHumans() }})</span>
                            </div>

                            @if (Auth::id() == $comment->user_id)
                                @include('components.posts.deleteComment', ['id' => $comment->id])
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
