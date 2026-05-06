<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // ================= LOGIN =================
    public function login()
    {
        return view('auth.login');
    }

    public function loginPost(Request $request)
    {
        // validasi sederhana
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();

            // 🔥 CEK ROLE
            if (Auth::user()->role === 'admin') {
                return redirect('/admin');
            }

            return redirect('/dashboard');
        }

        return back()->with('error', 'Email atau password salah');
    }

    // ================= REGISTER =================
    public function registerForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // validasi
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:4'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user' // default user
        ]);

        return redirect('/login')->with('success', 'Registrasi berhasil');
    }

    // ================= LOGOUT =================
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}