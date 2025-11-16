<?php

namespace App\Http\Controllers;

use App\Http\Requests\MasyarakatRequest;
use App\Models\Masyarakat;
use Hash;
use Illuminate\Http\Request;

class MasyarakatController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $daftarMasyarakat = Masyarakat::where('nama_lengkap', 'like', "%$search%")->orWhere('username', 'like', "%$search%")->paginate(10);
        return view('dashboard.masyarakat.index', compact('daftarMasyarakat'));
    }

    public function create()
    {
        return view('dashboard.masyarakat.create');
    }

    public function store(MasyarakatRequest $request)
    {
        $masyarakat = $request->validated();
        $masyarakat['password'] = Hash::make($masyarakat['password']);
        Masyarakat::create($masyarakat);

        flash()->addSuccess('Masyarakat berhasil dibuat!', 'Sukses');
        return to_route('masyarakat.index');
    }

    public function edit(Masyarakat $masyarakat)
    {
        return view('dashboard.masyarakat.edit', compact('masyarakat'));
    }

    public function update(MasyarakatRequest $request, Masyarakat $masyarakat)
    {
        if ($request->password) {
            $masyarakat->password = Hash::make($request->password);
        }
        $masyarakat->nama_lengkap = $request->nama_lengkap;
        $masyarakat->username = $request->username;
        $masyarakat->telp = $request->telp;
        $masyarakat->save();

        flash()->addSuccess('Masyarakat berhasil diperbarui!', 'Sukses');
        return to_route('masyarakat.index');
    }

    public function destroy(Masyarakat $masyarakat)
    {
        $masyarakat->delete();
        flash()->addSuccess('Masyarakat berhasil dihapus!', 'Sukses');
        return redirect()->back();
    }
}
