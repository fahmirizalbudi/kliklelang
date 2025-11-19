<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Lelang;
use Illuminate\Http\Request;

class LelangController extends Controller
{
    public function index()
    {
        $daftarLelang = Lelang::with(['historyLelang.masyarakat', 'barang'])->where('status', 'dibuka')->get();
        return response()->json([
            'status' => 200,
            'message' => 'Lelang data retrieved successfully.',
            'data' => $daftarLelang
        ]);
    }
}
