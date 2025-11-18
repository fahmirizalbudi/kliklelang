<?php

namespace App\Http\Controllers;

use App\Models\HistoryLelang;
use Illuminate\Http\Request;

class HistoryLelangController extends Controller
{
    public function __invoke()
    {
        $histories = HistoryLelang::with([
            'masyarakat',
            'lelang.barang'
        ])->paginate(7);
        return view('dashboard.lelang.history.index', compact('histories'));
    }
}
