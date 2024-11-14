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

            @include('components.posts.createComment', ['post_id' => $post->id, ])

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
