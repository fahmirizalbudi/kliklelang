<?php

namespace App\Http\Controllers;

use App\Http\Requests\BarangRequest;
use App\Models\Barang;
use Storage;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $daftarBarang = Barang::where('nama_barang', 'like', "%$search%")->paginate(7);
        return view('dashboard.barang.index', compact('daftarBarang'));
    }

    public function create()
    {
        return view('dashboard.barang.create');
    }

    public function store(BarangRequest $request)
    {
        $fotoBarang = $request->file('foto_barang');
        $filename = time() . '-' . $fotoBarang->getClientOriginalName();
        $fotoBarang->storeAs('foto_barang', $filename, 'public');

        Barang::create([
            'nama_barang' => $request->nama_barang,
            'tgl' => now()->toDateString(),
            'harga_awal' => $request->harga_awal,
            'deskripsi_barang' => $request->deskripsi_barang,
            'foto_barang' => $filename,
        ]);

        flash()->addSuccess('Barang berhasil dibuat!', 'Sukses');
        return to_route('barang.index');
    }

    public function edit(Barang $barang)
    {
        return view('dashboard.barang.edit', compact('barang'));
    }

    public function update(BarangRequest $request, Barang $barang)
    {
        if ($request->hasFile('foto_barang')) {
            if ($barang->foto_barang && Storage::disk('public')->exists('foto_barang/' . $barang->foto_barang)) {
                Storage::disk('public')->delete('foto_barang/' . $barang->foto_barang);
            }

            $fotoBaru = $request->file('foto_barang');
            $filename = time() . '-' . $fotoBaru->getClientOriginalName();
            $fotoBaru->storeAs('foto_barang', $filename, 'public');

            $barang->foto_barang = $filename;
        }

        $barang->nama_barang = $request->nama_barang;
        $barang->harga_awal = $request->harga_awal;
        $barang->deskripsi_barang = $request->deskripsi_barang;

        $barang->save();

        flash()->addSuccess('Barang berhasil diperbarui!', 'Sukses');
        return to_route('barang.index');
    }

    public function destroy(Barang $barang)
    {
        Storage::disk('public')->delete('foto_barang/' . $barang->foto_barang);
        $barang->delete();
        flash()->addSuccess('Barang berhasil dihapus!', 'Sukses');
        return redirect()->back();
    }
}
