<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController
{
    public function loginPage()
    {
        if (Auth::viaRemember()) {
            return redirect()->route('dashboard');
        }

        return view('pages.login');
    }

    public function login(Request $request)
    {
        $payload = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $remember_me = $request->remember_me ?? false;

        if (Auth::attempt($payload, $remember_me)) {
            return redirect()->route('dashboard');
        }

        return redirect()->back()->withErrors([
            'error' => 'Email or password is incorrect.'
        ]);
    }

    public function registerPage()
    {
        return view('pages.register');
    }

    public function register(Request $request)
    {
        $payload = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);

        $payload['password'] = bcrypt($payload['password']);
        $payload['role_id'] = 2;

        $user = User::create($payload);

        Auth::login($user);

        return redirect()->route('dashboard');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }
}
