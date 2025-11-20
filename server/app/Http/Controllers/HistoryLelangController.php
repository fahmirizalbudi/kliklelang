<?php

namespace App\Http\Controllers;

use App\Models\Lelang;
use Auth;
use Illuminate\Http\Request;

class HistoryLelangController extends Controller
{
    public function __invoke(Request $request)
    {
        $petugas = Auth::guard('petugas')->user();
        $search = $request->input('search');

        $mulai = $request->input('mulai');
        $sampai = $request->input('sampai');

        $histories = Lelang::with(['masyarakat', 'barang'])
            ->where('status', 'ditutup')
            ->where('id_petugas', Auth::guard('petugas')->id())
            ->where(function ($query) use ($search) {
                $query->whereHas('masyarakat', function ($q) use ($search) {
                    $q->where('nama_lengkap', 'like', "%$search%");
                })
                    ->orWhereHas('barang', function ($q) use ($search) {
                        $q->where('nama_barang', 'like', "%$search%");
                    });
            })->when($mulai, function ($query) use ($mulai) {
                $query->whereDate('tgl_lelang', '>=', $mulai);
            })->when($sampai, function ($query) use ($sampai) {
                $query->whereDate('tgl_lelang', '<=', $sampai);
            })->paginate(7);

        return view('dashboard.lelang.history.index', compact('histories'));
    }
}
