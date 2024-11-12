<footer class="flex flex-col items-center border-t border-slate-200 py-5 opacity-80">
    <h2 class="mb-1 font-bold text-2xl hover:text-red-400 duration-300"><a href="{{ route('main') }}">Blogadise</a></h2>

    <p class="{{ Auth::user() ? '' : 'mb-4'  }} text-slate-600">
        &copy; Blogadise {{ date('Y') }}. All rights reserved.
    </p>

    @if (!Auth::user())
        <div class="">
            <a href="{{ route('login') }}" class="bg-red-400 text-white hover:bg-red-300 hover:text-black duration-300 py-3 px-5 rounded-lg">Login</a>
        </div>
    @endif
</footer>
