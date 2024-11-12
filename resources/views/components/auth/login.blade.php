@extends('layout.template')

@section('content')
    @component('components.shared.formContainer')
        <form action="{{ route('login.post') }}" method="POST" class="bg-white p-6 rounded-lg shadow-lg border border-slate-200">
            @csrf

            <h2 class="text-2xl font-semibold mb-4">Login</h2>
            <div class="flex flex-col mb-2">
                <span class="mb-1">Email</span>
                <input type="email" name="email" id="email" value="{{ old('email') }}"
                    class="border border-slate-200 py-3 px-5 rounded-lg focus:outline-red-400">
                @if ($errors->has('email'))
                    <span class="text-red-400">{{ $errors->first('email') }}</span>
                @endif
            </div>

            <div class="flex flex-col mb-4">
                <span class="mb-1">Password</span>
                <input type="password" name="password" id="password"
                    class="border border-slate-200 py-3 px-5 rounded-lg focus:outline-red-400">
                @if ($errors->has('password'))
                    <span class="text-red-400">{{ $errors->first('password') }}</span>
                @endif
            </div>

            <div class="flex justify-between items-center gap-10">
                <p href="" class="">Don't have an account? <a href="{{ route('register') }}"
                        class="text-red-400 hover:text-red-300 duration-300">Register here</a></p>
                <button type="submit"
                    class="bg-red-400 text-white hover:bg-red-300 hover:text-black duration-300 py-3 px-5 rounded-lg text-end">Login</button>
            </div>
        </form>
    @endcomponent
@endsection
