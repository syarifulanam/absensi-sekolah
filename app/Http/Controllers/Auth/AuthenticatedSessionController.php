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

    // public function showForgotForm()
    // {
    //     return view('auth.forgot-password');
    // }

    // public function sendResetLink(Request $request)
    // {
    //     $request->validate(['email' => 'required|email']);

    //     $status = Password::sendResetLink(
    //         $request->only('email')
    //     );

    //     return $status === Password::RESET_LINK_SENT
    //         ? back()->with('status', __($status))
    //         : back()->withErrors(['email' => __($status)]);
    // }

    // public function showResetForm($token)
    // {
    //     return view('auth.reset-password', ['token' => $token]);
    // }

    // public function reset(Request $request)
    // {
    //     $request->validate([
    //         'token'    => 'required',
    //         'email'    => 'required|email',
    //         'password' => 'required|string|min:6|confirmed',
    //     ]);

    //     $status = Password::reset(
    //         $request->only('email', 'password', 'password_confirmation', 'token'),
    //         function ($user, $password) {
    //             $user->password = Hash::make($password);
    //             $user->save();
    //         }
    //     );

    //     return $status === Password::PASSWORD_RESET
    //         ? redirect()->route('login')->with('success', 'Password berhasil diubah!')
    //         : back()->withErrors(['email' => [__($status)]]);
    // }
}
