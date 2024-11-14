@extends('layout.template')

@section('content')
    @component('components.shared.formContainer')
        <form id="loginForm" action="{{ route('login.post') }}" method="POST" class="bg-white p-6 rounded-lg shadow-lg border border-slate-200">
            @csrf

            <h2 class="text-2xl font-semibold mb-4">Login</h2>

            <div class="flex flex-col mb-2">
                <label for="email" class="mb-1">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}"
                    class="border border-slate-200 py-3 px-5 rounded-lg focus:outline-red-400">
                <span id="emailError" class="text-red-400"></span>
                @if ($errors->has('email'))
                    <span class="text-red-400">{{ $errors->first('email') }}</span>
                @endif
            </div>

            <div class="flex flex-col mb-4">
                <label for="password" class="mb-1">Password</label>
                <input type="password" name="password" id="password"
                    class="border border-slate-200 py-3 px-5 rounded-lg focus:outline-red-400">
                <span id="passwordError" class="text-red-400"></span>
                @if ($errors->has('password'))
                    <span class="text-red-400">{{ $errors->first('password') }}</span>
                @endif
            </div>

            <div class="flex justify-between items-center gap-10">
                <p>Don't have an account? <a href="{{ route('register') }}"
                        class="text-red-400 hover:text-red-300 duration-300">Register here</a></p>
                <button type="submit"
                    class="bg-red-400 text-white hover:bg-red-300 hover:text-black duration-300 py-3 px-5 rounded-lg text-end">Login</button>
            </div>
        </form>
    @endcomponent
@endsection

@push('scripts')
<script>
    function validateEmail() {
        const emailField = document.getElementById('email');
        const emailError = document.getElementById('emailError');
        const email = emailField.value.trim();
        let isValid = true;

        emailError.innerText = '';

        if (!email) {
            emailError.innerText = 'Email is required.';
            isValid = false;
        } else if (!/^\S+@\S+\.\S+$/.test(email)) {
            emailError.innerText = 'Please enter a valid email address.';
            isValid = false;
        }

        return isValid;
    }

    function validatePassword() {
        const passwordField = document.getElementById('password');
        const passwordError = document.getElementById('passwordError');
        const password = passwordField.value;
        let isValid = true;

        passwordError.innerText = '';

        if (!password) {
            passwordError.innerText = 'Password is required.';
            isValid = false;
        } else if (password.length < 8) {
            passwordError.innerText = 'Password must be at least 8 characters.';
            isValid = false;
        } else if (password.length > 255) {
            passwordError.innerText = 'Password cannot exceed 255 characters.';
            isValid = false;
        }

        return isValid;
    }

    document.getElementById('loginForm').addEventListener('submit', function(event) {
        let isValid = true;

        if (!validateEmail()) isValid = false;
        if (!validatePassword()) isValid = false;

        if (!isValid) {
            event.preventDefault();
        }
    });

    document.getElementById('email').addEventListener('blur', validateEmail);
    document.getElementById('password').addEventListener('blur', validatePassword);
</script>
@endpush