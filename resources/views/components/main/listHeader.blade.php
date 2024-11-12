<div class="flex flex-col md:flex-row items-center justify-between">
    <h1 class="text-3xl font-bold mb-2 md:mb-0">Posts</h1>

    <form action="{{ route('main') }}" method="GET" class="flex items-center mb-2 md:mb-0">
        <input type="text" name="search" placeholder="Search posts..." value="{{ request('search') }}"
            class="border border-slate-200 py-2 px-4 rounded-lg focus:outline-red-400">
        <button type="submit"
            class="ml-2 bg-red-400 text-white py-2 px-4 rounded-lg hover:text-black hover:bg-red-300 duration-300">
            Search
        </button>
    </form>

    <a href="{{ Auth::check() ? route('posts.create') : route('login') }}" class="w-full sm:w-auto">
        <button
            class="w-full sm:w-auto flex justify-center bg-red-400 px-4 py-2 shadow-md rounded-lg text-white hover:text-black hover:bg-red-300 duration-300">
            <x-tabler-plus class="me-1" />
            Add a Post
        </button>
    </a>
</div>