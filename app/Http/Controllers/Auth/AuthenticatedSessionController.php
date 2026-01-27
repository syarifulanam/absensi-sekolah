<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    public function store(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
            'role'     => ['required', 'in:admin,guru,siswa'],
        ]);

        if (!Auth::attempt([
            'email' => $credentials['email'],
            'password' => $credentials['password'],
        ], $request->boolean('remember'))) {

            return back()->withErrors([
                'email' => 'Email atau password salah',
            ])->onlyInput('email');
        }

        $request->session()->regenerate();

        if (auth()->user()->role !== $credentials['role']) {
            Auth::logout();

            return back()->withErrors([
                'email' => 'Role tidak sesuai dengan akun',
            ]);
        }

        return match (auth()->user()->role) {
            'admin' => redirect()->intended('/dashboard'),
            'guru'  => redirect()->intended('/absensi/scan-camera'),
            'siswa' => redirect()->intended('/absensi-saya'),
            default => redirect('/'),
        };
    }
}
