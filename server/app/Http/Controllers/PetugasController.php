<?php

namespace App\Http\Controllers;

use App\Http\Requests\PetugasRequest;
use App\Models\Level;
use App\Models\Petugas;
use Auth;
use Hash;
use Illuminate\Http\Request;

class PetugasController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $daftarPetugas = Petugas::with('level')->where('nama_petugas', 'like', "%$search%")->orWhere('username', 'like', "%$search%")->paginate(10);
        return view('dashboard.petugas.index', compact('daftarPetugas'));
    }

    public function create()
    {
        $daftarLevel = Level::all(['id_level', 'level']);
        return view('dashboard.petugas.create', compact('daftarLevel'));
    }

    public function store(PetugasRequest $request)
    {
        $petugas = $request->validated();
        $petugas['password'] = Hash::make($petugas['password']);
        Petugas::create($petugas);

        flash()->addSuccess('Petugas berhasil dibuat!', 'Sukses');
        return to_route('petugas.index');
    }

    public function edit(Petugas $petugas)
    {
        $daftarLevel = Level::all(['id_level', 'level']);
        return view('dashboard.petugas.edit', compact('petugas', 'daftarLevel'));
    }

    public function update(PetugasRequest $request, Petugas $petugas)
    {
        if ($request->password) {
            $petugas->password = Hash::make($request->password);
        }
        $petugas->nama_petugas = $request->nama_petugas;
        $petugas->username = $request->username;
        $petugas->id_level = $request->id_level;
        $petugas->save();

        flash()->addSuccess('Petugas berhasil diperbarui!', 'Sukses');
        return to_route('petugas.index');
    }

    public function destroy(Petugas $petugas)
    {
        if (Auth::guard('petugas')->id() === $petugas->id_petugas) {
            flash()->addError('Akun sedang dipakai!', 'Gagal');
        } else {
            $petugas->delete();
            flash()->addSuccess('Petugas berhasil dihapus!', 'Sukses');
        }
        return redirect()->back();
    }
}
