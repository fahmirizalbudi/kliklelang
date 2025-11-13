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
            sweetalert()->addError(null, 'Username atau password salah. Silakan coba lagi.');
            return redirect()->back()->withInput();
        }

        $request->session()->regenerate();
        return redirect()->intended('/');
    }

    public function login_masyarakat(Request $request)
    {
        dd('masyarakat');
    }
}
