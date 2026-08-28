<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('signin');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        // Email dan Password yang dikunci
        $defaultEmail = 'admin@rentalps.com';
        $defaultPassword = 'admin123';

        if ($request->email === $defaultEmail && $request->password === $defaultPassword) {
            session(['user' => $request->email]);
            return redirect('/dashboard')->with('success', 'Selamat datang kembali!');
        }

        return back()->withErrors(['email' => 'Email atau Password salah!'])->withInput();
    }

    public function logout(Request $request)
    {
        $request->session()->forget('user');
        return redirect('/login');
    }
}