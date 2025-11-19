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

        $histories = Lelang::with(['masyarakat', 'barang'])
            ->where('status', 'ditutup')
            ->where(function ($query) use ($search) {
                $query->whereHas('masyarakat', function ($q) use ($search) {
                    $q->where('nama_lengkap', 'like', "%$search%");
                })
                    ->orWhereHas('barang', function ($q) use ($search) {
                        $q->where('nama_barang', 'like', "%$search%");
                    });
            })
            ->paginate(7);

        return view('dashboard.lelang.history.index', compact('histories'));
    }
}
