<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PHPUnit\Framework\Attributes\WithoutErrorHandler;

class AuthController extends Controller
{
    public function login() 
    {
        return view('auth.login');
    }
    public function authenticated(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);
        
        $credentials = $request->only(['email', 'password']);
        
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard')
                ->with('success', 'You have successfully logged in!');
        }

        return back() ->withErrors([
            'loginError' => 'Email atau password salah'
        ]);


    }

}
