<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Tampilkan halaman login.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Proses login pengguna menggunakan username dan password.
     */
    public function store(Request $request): RedirectResponse
    {
        // Validasi input form login
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Proses autentikasi menggunakan kolom username
        if (Auth::attempt([
            'username' => $request->username,
            'password' => $request->password
        ], $request->boolean('remember'))) {

            // Regenerasi session untuk keamanan
            $request->session()->regenerate();

            // Redirect ke dashboard atau halaman tujuan
            return redirect()->intended(RouteServiceProvider::HOME);
        }

        // Jika login gagal, kembalikan dengan pesan error
        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ])->onlyInput('username');
    }

    /**
     * Logout dan hapus session pengguna.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
