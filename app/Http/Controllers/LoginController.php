<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Menampilkan halaman login, tetapi jika sudah login, redirect ke dashboard sesuai role.
     */
    public function index()
    {
        if (Auth::check()) {
            return $this->redirectToDashboard(Auth::user()->role);
        }

        return view('page.login'); // Jika belum login, tampilkan halaman login
    }

    /**
     * Proses login
     */
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required',
        ], [
            'username.required' => 'Username wajib diisi',
            'password.required' => 'Password wajib diisi',
        ]);

        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            return $this->redirectToDashboard(Auth::user()->role);
        } 
        
        return redirect()->back()
            ->withErrors(['login' => 'Username dan password yang dimasukkan tidak sesuai'])
            ->withInput();
    }

    /**
     * Proses logout
     */
    public function logout()
    {
        Auth::logout();
        session()->invalidate(); // Menghapus session
        session()->regenerateToken(); // Regenerasi token untuk keamanan

        return redirect()->route('page.login'); // Redirect ke halaman login setelah logout
    }

    /**
     * Redirect ke dashboard berdasarkan role pengguna
     */
    private function redirectToDashboard($role)
    {
        switch ($role) {
            case 'admin':
                return redirect()->route('dashboard.admin');
            case 'guru':
                return redirect()->route('dashboard.guru');
            case 'siswa':
                return redirect()->route('dashboard.siswa');
            default:
                return redirect()->route('page.login'); // Jaga-jaga jika role tidak dikenal
        }
    }
}
