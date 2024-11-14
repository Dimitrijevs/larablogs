<nav class="flex justify-between text-center border-b pb-5 mb-10 border-slate-200">
    <h2 class="font-bold text-2xl hover:text-red-400 duration-300"><a href="{{ route('main') }}">Blogadise</a></h2>

    <ul class="flex items-center gap-3">
        @if (!Auth::user())
            <li>
                <a href="{{ route('login') }}"
                    class="{{ Route::currentRouteName() == 'login' ? 'font-bold' : '' }} hover:font-bold duration-300">
                    Login
                </a>
            </li>
            <li>
                <a href="{{ route('register') }}"
                    class="{{ Route::currentRouteName() == 'register' ? 'font-bold' : '' }} hover:font-bold duration-300">
                    Register
                </a>
            </li>
        @else
            <li class="">
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="hover:font-bold duration-300 flex items-center">
                        <x-tabler-login-2 class="me-1" />
                        Logout
                    </button>
                </form>
            </li>
        @endif
    </ul>
</nav>
