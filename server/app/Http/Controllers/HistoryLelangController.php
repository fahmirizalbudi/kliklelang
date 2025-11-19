<?php

namespace App\Http\Controllers;

use App\Models\HistoryLelang;
use Auth;
use Illuminate\Http\Request;

class HistoryLelangController extends Controller
{
    public function __invoke()
    {
        $petugas = Auth::guard('petugas')->user();

        $histories = HistoryLelang::with([
            'masyarakat',
            'lelang.barang'
        ])->whereHas('lelang', function($query) use ($petugas) {
            $query->where('id_petugas', $petugas->id_petugas);
        })->paginate(7);

        return view('dashboard.lelang.history.index', compact('histories'));
    }
}
