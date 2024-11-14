<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
    public function showLogin(): View
    {
        return view('components.auth.login');
    }

    public function login(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8|max:255'
        ]);

        if (Auth::attempt($validated)) {
            $request->session()->regenerate();
 
            return redirect()->intended('/')->with('message', 'You are logged in!');
        }

        return redirect()->route('login')->withErrors(['email' => 'Invalid email or password']);
    }

    public function showRegister(): View
    {
        return view('components.auth.register');
    }

    public function register(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|min:3|max:255|regex:/^[\p{L}0-9\s]+$/u',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|max:255|confirmed'
        ]);

        $validated['password'] = bcrypt($validated['password']);

        $user = User::create($validated);

        Auth::login($user);

        return redirect()->route('main')->with('message', 'You are registered and logged in!');
    }

    public function logout(): RedirectResponse
    {
        Auth::logout();

        return redirect()->route('main')->with('message', 'You are logged out!');
    }
}
