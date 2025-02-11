<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('page.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required',
        ], [
            'username.required' => 'Username wajib diisi',
            'password.required' => 'Password wajib diisi',
        ]);
    
        $infologin = [
            'username' => $request->username,
            'password' => $request->password,
        ];
    
        if (Auth::attempt($infologin)) {
            if (Auth::user()->role === 'admin') {
                return redirect()->route('dashboard.admin');
            } elseif (Auth::user()->role === 'guru') {
                return redirect()->route('dashboard.guru');
            } elseif (Auth::user()->role === 'siswa') {
                return redirect()->route('dashboard.siswa');
            }
        } else {
            return redirect()->back()->withErrors('Username dan password yang dimasukkan tidak sesuai')->withInput();
        }
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('page.login'); // or use the route you want to redirect to
    }
}
