<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('src.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/index');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }
    
    public function logout(Request $request)
    {
     Auth::logout();
     $request->session()->invalidate();
     $request->session()->regenerateToken();

     return redirect('/login');
    }

}