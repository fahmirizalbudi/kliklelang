<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\Masyarakat;
use App\Models\Petugas;
use Auth;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
            'password' => 'required|confirmed|min:6',
            'telp' => 'required',
            'alamat' => 'required',
        ], [
            'nama_lengkap.required' => 'Nama lengkap wajib diisi.',
            'nik.required' => 'NIK wajib diisi.',
            'nik.digits' => 'NIK harus berisi tepat 16 digit.',
            'username.required' => 'Username wajib diisi.',
            'password.required' => 'Password wajib diisi.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'telp.required' => 'Nomor telepon wajib diisi.',
            'alamat.required' => 'Alamat wajib diisi.',
        ]);

        $masyarakat['password'] = Hash::make($masyarakat['password']);
        $masyarakat['status'] = 'aktif';
        Masyarakat::create($masyarakat);

        flash()->addSuccess('Akun berhasil dibuat!', 'Sukses');
        return redirect()->back();
    }

    public function updatePetugas(Request $request, Petugas $petugas)
    {
        $validated = $request->validate([
            'nama_petugas' => 'required',
            'username' => [
                'required',
                Rule::unique('tb_petugas', 'username')->ignore($petugas),
                Rule::unique('tb_masyarakat', 'username')->ignore($petugas, 'id_user'),
            ],
            'password' => 'nullable|confirmed|min:6'
        ], [
            'nama_petugas.required' => 'Nama petugas wajib diisi.',
            'username.required' => 'Username wajib diisi.',
            'username.unique' => 'Username sudah digunakan, silakan pilih yang lain.',
            'password.min' => 'Password minimal harus 6 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        $petugas->nama_petugas = $validated['nama_petugas'];
        $petugas->username = $validated['username'];

        if (isset($validated['password'])) {
            $petugas->password = Hash::make($validated['password']);
        }

        $petugas->save();

        flash()->addSuccess('Profil berhasil diperbarui.');
        return redirect()->back();
    }

    public function updateMasyarakat(Request $request, Masyarakat $masyarakat)
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required',
            'username' => [
                'required',
                Rule::unique('tb_masyarakat', 'username')->ignore($masyarakat),
                Rule::unique('tb_petugas', 'username')->ignore($masyarakat, 'id_petugas'),
            ],
            'password' => 'nullable|confirmed|min:6',
            'telp' => 'required',
            'alamat' => 'required',
            'nik' => [
                'required',
                'min:16',
                'max:16',
                Rule::unique('tb_masyarakat', 'nik')->ignore($masyarakat),
            ],
        ], [
            'nama_lengkap.required' => 'Nama petugas wajib diisi.',
            'username.required' => 'Username wajib diisi.',
            'username.unique' => 'Username sudah digunakan, silakan pilih yang lain.',
            'password.min' => 'Password minimal harus 6 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'telp.required' => 'Telepon wajib diisi.',
            'alamat.required' => 'Alamat wajib diisi.',
            'nik.required' => 'NIK wajib diisi.',
            'nik.unique' => 'NIK sudah digunakan, silakan pilih yang lain.',
            'nik.min' => 'NIK harus berisi tepat 16 digit.',
            'nik.max' => 'NIK harus berisi tepat 16 digit.',
        ]);

        $masyarakat->nama_lengkap = $validated['nama_lengkap'];
        $masyarakat->username = $validated['username'];
        $masyarakat->telp = $validated['telp'];
        $masyarakat->alamat = $validated['alamat'];
        $masyarakat->nik = $validated['nik'];

        if (isset($validated['password'])) {
            $masyarakat->password = Hash::make($validated['password']);
        }

        $masyarakat->save();

        flash()->addSuccess('Profil berhasil diperbarui.');
        return redirect()->back();
    }

    public function profile()
    {
        $view = null;
        if (Auth::guard('petugas')->check()) {
            $view = 'auth.petugas.profile';
        } else {
            $view = 'auth.masyarakat.profile';
        }
        return view($view);
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
