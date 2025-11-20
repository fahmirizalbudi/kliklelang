<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\Masyarakat;
use App\Models\Petugas;
use Auth;
use Hash;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function viewLogin()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        $login = $request->login;
        $password = $request->password;

        $petugas = Petugas::where('username', $login)->first();
        if ($petugas && Hash::check($password, $petugas->password)) {
            Auth::guard('petugas')->login($petugas);
            $request->session()->regenerate();
            return to_route('home');
        }

        $masyarakat = Masyarakat::where('username', $login)->orWhere('nik', $login)->first();
        if ($masyarakat && Hash::check($password, $masyarakat->password)) {
            Auth::guard('masyarakat')->login($masyarakat);
            $request->session()->regenerate();

            if (Auth::guard('masyarakat')->user()->status !== 'aktif') {
                sweetalert()->addError('Akun diblokir, silahkan hubungi admin.', 'Akun Diblokir');
                Auth::guard('masyarakat')->logout();
                return to_route('login.view');
            }

            return to_route('app.index');
        }

        sweetalert()->addError('Username atau password salah. Silakan coba lagi.', 'Login Gagal');
        return redirect()->back()->withInput();
    }

    public function viewRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $masyarakat = $request->validate([
            'nama_lengkap' => 'required',
            'nik' => 'required|digits:16',
            'username' => 'required',
            'password' => 'required',
            'telp' => 'required',
            'alamat' => 'required',
        ], [
            'nama_lengkap.required' => 'Nama lengkap wajib diisi.',
            'nik.required' => 'NIK wajib diisi.',
            'nik.digits' => 'NIK harus berisi tepat 16 digit.',
            'username.required' => 'Username wajib diisi.',
            'password.required' => 'Password wajib diisi.',
            'telp.required' => 'Nomor telepon wajib diisi.',
            'alamat.required' => 'Alamat wajib diisi.',
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
                break;

            case Auth::guard('masyarakat')->check():
                Auth::guard('masyarakat')->logout();
                break;

            default:
                Auth::logout();
                break;
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return to_route('login.view');
    }
}
