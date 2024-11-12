<div class="my-6">
    @if ($posts->count())
        <div class="post grid gap-8 grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            @foreach ($posts as $post)
                <div
                    class="p-4 row-span-1 border-b border-slate-200 hover:-translate-y-1 duration-300 shadow-md hover:shadow-lg rounded-xl">
                    <div class="flex flex-col justify-between h-full">
                        <div class="mb-2">
                            <a href="{{ route('posts.show', $post->id) }}">
                                <div class="flex items-center">
                                    <x-tabler-clipboard-typography class="h-8 w-8 me-1" />
                                    <h2 class="font-semibold text-xl">{{ Str::limit($post->title, 12) }}</h2>
                                </div>
                                <p class="text-slate-600">{{ Str::limit($post->content, 80) }}</p>
                            </a>
                        </div>
                        <div class="flex justify-between">
                            <p class="text-slate-600 text-end">{{ $post->created_at->format('d.m.Y.') }}</p>
                            @if (Auth::id() == $post->user_id)
                                <div class="flex">
                                    @include('components.main.deletePost', ['id' => $post->id])
                                    <a href="{{ route('posts.edit', $post->id) }}" class="me-1">
                                        <x-tabler-pencil-cog class="text-blue-400" />
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="h-[40vh] flex items-center justify-center">
            <p class="text-center">No posts found :(</p>
        </div>
    @endif

    @if ($posts->count())
        <div class="mt-6 flex justify-end">
            {{ $posts->links('pagination::tailwind') }}
        </div>
    @endif
</div>
