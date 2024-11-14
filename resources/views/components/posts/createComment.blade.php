<div class="mb-5">
    @if (Auth::check())
        <form action="{{ route('comments.store', $post_id) }}" method="POST">
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