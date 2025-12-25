<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; 

class AuthController extends Controller
{
    public function showLogin() {
        return view('auth.login');
    }

    /**
     * Mengimplementasikan metode + login(email, password) : Boolean
     * dari Class Diagram
     */
    public function login(Request $request) {
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        
        /** * KONSEP POLIMORFISME (Dynamic Binding):
         * Kita memanggil getDashboardRoute(). Laravel secara otomatis akan menjalankan
         * fungsi milik Admin jika yang login Admin, atau milik Guru jika yang login Guru.
         * Tidak perlu lagi cek IF-ELSE berdasarkan role.
         */
        return redirect()->route(Auth::user()->getDashboardRoute()); 
    }

    return back()->withErrors(['email' => 'Email atau password salah!']);
}
    /**
     * Mengimplementasikan metode + logout() : void
     * dari Class Diagram
     */
    public function logout(Request $request) {
        // Panggil fungsionalitas logout sistem
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/login')->with('success', 'Anda telah keluar.');
    }
}