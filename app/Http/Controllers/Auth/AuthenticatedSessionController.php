<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class AuthenticatedSessionController extends Controller
{
    public function store(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
            'role'     => ['required', 'in:admin,teacher,student'],
        ]);

        if (!Auth::attempt([
            'email' => $credentials['email'],
            'password' => $credentials['password'],
        ], $request->boolean('remember'))) {

            return back()->withErrors([
                'email' => 'Incorrect email or password',
            ])->onlyInput('email');
        }

        $request->session()->regenerate();

        if (auth()->user()->role !== $credentials['role']) {
            Auth::logout();

            return back()->withErrors([
                'email' => 'Role does not match the account',
            ]);
        }

        return match (auth()->user()->role) {
            'admin' => redirect()->intended('/dashboard'),
            'teacher'  => redirect()->intended('/scan-camera'),
            'student' => redirect()->intended('student/attendance'),
            default => redirect('/'),
        };
    }

    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
