@extends('layout.template')

@section('content')
    @component('components.shared.formContainer')
        <form id="registerForm" action="{{ route('register.post') }}" method="POST"
            class="bg-white p-6 rounded-lg shadow-lg border border-slate-200">
            @csrf

            <h2 class="text-2xl font-semibold mb-4">Register</h2>

            <div class="flex flex-col mb-2">
                <label for="name" class="mb-1">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}"
                    class="border border-slate-200 py-3 px-5 rounded-lg focus:outline-red-400">
                <span id="nameError" class="text-red-400"></span>
                @if ($errors->has('name'))
                    <span class="text-red-400">{{ $errors->first('name') }}</span>
                @endif
            </div>

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

            <div class="flex flex-col mb-4">
                <label for="password_confirmation" class="mb-1">Password Confirmation</label>
                <input type="password" name="password_confirmation" id="password_confirmation"
                    class="border border-slate-200 py-3 px-5 rounded-lg focus:outline-red-400">
                <span id="passwordConfirmationError" class="text-red-400"></span>
                @if ($errors->has('password_confirmation'))
                    <span class="text-red-400">{{ $errors->first('password_confirmation') }}</span>
                @endif
            </div>

            <div class="flex justify-between items-center gap-10">
                <p>Already have an account? <a href="{{ route('login') }}"
                        class="text-red-600 hover:text-red-400 duration-300">Login here</a></p>
                <button type="submit"
                    class="bg-red-400 text-white hover:bg-red-300 hover:text-black duration-300 py-3 px-5 rounded-lg">Register</button>
            </div>
        </form>
    @endcomponent
@endsection

@push('scripts')
    <script>
        function validateName() {
            const nameField = document.getElementById('name');
            const nameError = document.getElementById('nameError');
            const name = nameField.value.trim();
            let isValid = true;

            nameError.innerText = '';

            if (!name) {
                nameError.innerText = 'Name is required.';
                isValid = false;
            } else if (name.length < 3) {
                nameError.innerText = 'Name must be at least 3 characters.';
                isValid = false;
            } else if (name.length > 255) {
                nameError.innerText = 'Name cannot exceed 255 characters.';
                isValid = false;
            } else if (!/^[\p{L}0-9\s]+$/u.test(name)) {
                nameError.innerText = 'Name can only contain letters, numbers, and spaces.';
                isValid = false;
            }

            return isValid;
        }

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

        function validatePasswordConfirmation() {
            const passwordField = document.getElementById('password');
            const passwordConfirmationField = document.getElementById('password_confirmation');
            const passwordConfirmationError = document.getElementById('passwordConfirmationError');
            const password = passwordField.value;
            const passwordConfirmation = passwordConfirmationField.value;
            let isValid = true;

            passwordConfirmationError.innerText = '';

            if (!passwordConfirmation) {
                passwordConfirmationError.innerText = 'Please confirm your password.';
                isValid = false;
            } else if (password !== passwordConfirmation) {
                passwordConfirmationError.innerText = 'Passwords do not match.';
                isValid = false;
            }

            return isValid;
        }

        document.getElementById('registerForm').addEventListener('submit', function(event) {
            let isValid = true;

            if (!validateName()) isValid = false;
            if (!validateEmail()) isValid = false;
            if (!validatePassword()) isValid = false;
            if (!validatePasswordConfirmation()) isValid = false;

            if (!isValid) {
                event.preventDefault();
            }
        });
    </script>
@endpush
