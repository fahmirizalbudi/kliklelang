<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\Masyarakat;
use Auth;
use Hash;
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
        return redirect()->intended(route('home'));
    }

    public function login_masyarakat(LoginRequest $request)
    {
        $credentials = $request->validated();
        if (!Auth::guard('masyarakat')->attempt($credentials)) {
            sweetalert()->addError('Username atau password salah. Silakan coba lagi.', 'Login Gagal');
            return redirect()->back()->withInput();
        }

        if (Auth::guard('masyarakat')->user()->status !== 'aktif') {
            sweetalert()->addError('Akun diblokir, silahkan hubungi admin.', 'Akun Diblokir');
            Auth::guard('masyarakat')->logout();
            return to_route('login.view.masyarakat');
        }

        $request->session()->regenerate();
        return redirect()->intended(route('app.index'));
    }

    public function viewRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $masyarakat = $request->validate([
            'nama_lengkap' => 'required',
            'username' => 'required',
            'password' => 'required',
            'telp' => 'required',
            'alamat' => 'required',
        ]);

        $masyarakat['password'] = Hash::make($masyarakat['password']);
        $masyarakat['status'] = 'aktif';
        Masyarakat::create($masyarakat);

        flash()->addSuccess('Akun berhasil dibuat!', 'Sukses');
        return redirect()->back();
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
