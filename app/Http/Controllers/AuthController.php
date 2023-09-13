<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    //
    public function index()
    {
        return view('auth.login');
    }

    public function register_index()
    {
        return view('auth.register');
    }

    public function register(RegisterRequest $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => \Hash::make($request->password),
        ]);
        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->route('admin');
        }
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->user();

        auth()->login($user);

        // return home after login
        return redirect()->route('home');
    }
    public function login(Request $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->route('admin');
        }
        return redirect('register')->withErrors('error');
    }

    public function logout()
    {
        \Session::flush();
        Auth::logout();
        return redirect('');
    }
}
