<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\HistoryLelang;
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

    public function bid(Request $request, Lelang $lelang)
    {
        $bid = $lelang->historyLelang->count() > 0
            ? $lelang->historyLelang->max('penawaran_harga')
            : $lelang->barang->harga_awal;

        if ($request->penawaran_harga <= $bid) {
            return response()->json([
                'status' => 400,
                'message' => 'Your bid is lower than max price.',
                'data' => null
            ], 400);
        }

        HistoryLelang::create([
            'id_lelang' => $lelang->id_lelang,
            'id_barang' => $lelang->barang->id_barang,
            'id_user' => $request->masyarakat->id_user,
            'penawaran_harga' => $request->penawaran_harga,
        ]);

        return response()->json([
            'status' => 200,
            'message' => 'Place bid is successfully.',
            'data' => null
        ]);
    }

    public function history(Request $request)
    {
        $history = Lelang::with(['barang', 'masyarakat', 'historyLelang'])
            ->whereHas('historyLelang', function ($query) use ($request) {
                $query->where('id_user', $request->masyarakat->id_user);
            })
            ->get();

        $history = $history->map(function ($h) use ($request) {
            if ($h->status === 'dibuka') {
                $h->status_lelang = 'proses';
            } elseif ($h->id_user == $request->masyarakat->id_user) {
                $h->status_lelang = 'menang';
            } else {
                $h->status_lelang = 'kalah';
            }
            return $h;
        });

        return response()->json([
            'status' => 200,
            'message' => 'History lelang data retrieved successfully',
            'data' => $history
        ]);
    }

    public function comingSoon(Request $request)
    {
        $comingSoon = Lelang::with('barang')->whereDate('tgl_lelang', '>', now()->toDateString());

        return response()->json([
            'status' => 200,
            'message' => 'Coming soon lelang data retrieved successfully',
            'data' => $comingSoon
        ]);
    }

    public function detail(Lelang $lelang)
    {
        $detailLelang = $lelang->load(['masyarakat', 'barang', 'historyLelang.masyarakat']);

        return response()->json([
            'status' => 200,
            'message' => 'Detail lelang data retrieved successfully.',
            'data' => $detailLelang
        ]);
    }
}
