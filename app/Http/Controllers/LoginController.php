<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    //halaman login
    public function ReadLogin()
    {
        return view('auth/login');
    }
    //Login User
    public function Login(Request $request)
    {
        $validatelogin = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ], [
            'username.required' => 'Username Harus di Isi',
            'password.required' => 'Password harus di Isi',
        ]);
        if (Auth::attempt($validatelogin)) {
            $request->session()->regenerate();
            // return redirect()->intended('dashboard')->with('login', 'Login Berhasil');
            return redirect()->intended('dashboard')->with('toast_success', 'Login Berhasil');
        }
        return back()->with('gagal', 'Periksa Kembali Username dan Password');
    }
    // Logout user
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
        // Auth::logout();
    }
}
