<?php

namespace App\Http\Controllers;

use App\Models\HistoryLelang;
use App\Models\Lelang;
use Auth;
use Illuminate\Http\Request;

class AppController extends Controller
{
    public function index()
    {
        return view('app.index');
    }

    public function lelang()
    {
        $daftarLelang = Lelang::with(['historyLelang', 'barang'])->where('status', 'dibuka')->get();
        return view('app.lelang.index', compact('daftarLelang'));
    }

    public function lelangBid(Lelang $lelang)
    {
        $lelang->load(['historyLelang.masyarakat', 'barang']);
        return view('app.lelang.bid.index', compact('lelang'));
    }

    public function lelangBidding(Request $request, Lelang $lelang)
    {
        $masyarakat = Auth::guard('masyarakat');

        if (!$masyarakat->check()) {
            flash()->addError('Silahkan log in terlebih dahulu!');
            return redirect()->back();
        }

        $bid = $lelang->historyLelang->count() > 0
            ? $lelang->historyLelang->max('penawaran_harga')
            : $lelang->barang->harga_awal;

        if ($request->penawaran_harga <= $bid) {
            flash()->addError('Penawaran Anda harus lebih tinggi dari penawaran sebelumnya!');
            return redirect()->back()->withInput();
        }

        HistoryLelang::create([
            'id_lelang' => $lelang->id_lelang,
            'id_barang' => $lelang->barang->id_barang,
            'id_user' => $masyarakat->user()->id_user,
            'penawaran_harga' => $request->penawaran_harga,
        ]);

        flash()->addSuccess('Penawaran berhasil diajukan!');
        return redirect()->back();
    }

    public function history()
    {
        $masyarakat = Auth::guard('masyarakat')->user();
        $daftarLelang = Lelang::with(['barang', 'masyarakat', 'historyLelang'])
            ->whereHas('historyLelang', function ($query) use ($masyarakat) {
                $query->where('id_user', $masyarakat->id_user);
            })
            ->get();

        return view('app.lelang.riwayat.index', compact('daftarLelang'));
    }
}
