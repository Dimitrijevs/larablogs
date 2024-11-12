<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('components.auth.login');
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8|max:255'
        ]);

        if (Auth::attempt($validated)) {
            $request->session()->regenerate();
 
            return redirect()->intended('/');
        }

        return redirect()->route('login')->withErrors(['email' => 'Invalid email or password']);
    }

    public function showRegister()
    {
        return view('components.auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|min:3|max:255|regex:/^[\p{L}0-9\s]+$/u',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|max:255|confirmed'
        ]);

        $validated['password'] = bcrypt($validated['password']);

        $user = User::create($validated);

        Auth::login($user);

        return redirect()->route('main');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('main');
    }
}
