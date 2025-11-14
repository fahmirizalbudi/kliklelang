<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function view_login()
    {
        return view('auth.login');
    }

    public function login_petugas(LoginRequest $request)
    {
        $credentials = $request->validated();
        if (!Auth::guard('petugas')->attempt($credentials)) {
            sweetalert()->addError('Username atau password salah. Silakan coba lagi.', 'Login Gagal');
            return redirect()->back()->withInput();
        }

        $request->session()->regenerate();
        return redirect()->intended('/');
    }

    public function login_masyarakat(Request $request)
    {
        dd('masyarakat');
    }

    public function logout(Request $request)
    {
        switch (true) {
            case Auth::guard('petugas')->check():
                Auth::guard('petugas')->logout();
                $redirect = '/auth/login/petugas';
                break;

            case Auth::guard('masyarakat')->check():
                Auth::guard('masyarakat')->logout();
                $redirect = '/auth/login/masyarakat';
                break;

            default:
                Auth::logout();
                break;
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect($redirect);
    }
}
