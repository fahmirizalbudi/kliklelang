<?php

namespace App\Http\Controllers;

use App\Data\LelangOverviewCard;
use App\Models\Barang;
use App\Models\Lelang;
use Auth;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class LelangController extends Controller
{
    private $filterItems;

    public function __construct(Lelang $lelang)
    {
        $this->filterItems = [
            ['label' => 'Semua', 'value' => ''],
            ['label' => 'Dibuka', 'value' => 'dibuka'],
            ['label' => 'Ditutup', 'value' => 'ditutup'],
            ['label' => 'Selesai', 'value' => 'selesai'],
        ];
    }

    public function index(Request $request, LelangOverviewCard $overview)
    {
        $petugas = Auth::guard('petugas')->user();
        $items = $overview->items($petugas->id_petugas);
        $filterItems = $this->filterItems;
        $status = $request->input('status');
        $daftarLelang = Lelang::with(['petugas', 'masyarakat', 'barang'])->where('id_petugas', $petugas->id_petugas);
        if ($status === 'dibuka') {
            $daftarLelang->where('status', 'dibuka');
        } elseif ($status === 'ditutup') {
            $daftarLelang->where('status', 'ditutup')->whereNull('id_user');
        } elseif ($status === 'selesai') {
            $daftarLelang->where('status', 'ditutup')->whereNotNull('id_user');
        }
        $daftarLelang = $daftarLelang->paginate(7);
        return view('dashboard.lelang.index', compact('items', 'filterItems', 'daftarLelang'));
    }

    public function activation()
    {
        $daftarBarang = Barang::all();
        return view('dashboard.lelang.activation', compact('daftarBarang'));
    }

    public function activate(Request $request)
    {
        $lelang = $request->validate([
            'id_barang' => 'required',
            'tgl_lelang' => 'required|date|after_or_equal:today',
            'status' => 'required|in:dibuka,ditutup',
        ], [
            'id_barang.required' => 'Barang wajib diisi.',
            'tgl_lelang.required' => 'Tanggal lelang wajib diisi.',
            'tgl_lelang.after_or_equal' => 'Tanggal lelang harus hari ini atau tanggal berikutnya.',
            'status.required' => 'Status wajib diisi.',
            'status.in' => 'Status harus "dibuka" atau "ditutup".',
        ]);

        $lelang['harga_akhir'] = null;
        $lelang['id_user'] = null;
        $lelang['id_petugas'] = Auth::guard('petugas')->user()->id_petugas;

        Lelang::create($lelang);
        flash()->addSuccess('Lelang berhasil di-aktivasi!', 'Sukses');

        return to_route('lelang.index');
    }

    public function open(Lelang $lelang)
    {
        $lelang->status = 'dibuka';
        $lelang->id_user = null;
        $lelang->harga_akhir = null;
        $lelang->save();
        flash()->addSuccess('Lelang berhasil dibuka!', 'Sukses');
        return redirect()->back();
    }

    public function close(Lelang $lelang)
    {
        $lelang->load('historyLelang');

        if ($lelang->historyLelang->count() > 0) {
            $pemenang = $lelang->historyLelang->sortByDesc('penawaran_harga')->first();
            $lelang->harga_akhir = $pemenang->penawaran_harga;
            $lelang->id_user = $pemenang->id_user;
        }

        $lelang->status = 'ditutup';
        $lelang->save();
        flash()->addSuccess('Lelang berhasil ditutup!', 'Sukses');
        return redirect()->back();
    }

    public function detail(Lelang $lelang)
    {
        $lelang->load(['barang', 'historyLelang.masyarakat']);
        return view('dashboard.lelang.detail.index', compact('lelang'));
    }

    public function destroy(Lelang $lelang)
    {
        try {
            if ($lelang->status === 'dibuka') {
                flash()->addError('Lelang masih dibuka!', 'Gagal');
                return redirect()->back();
            }
            $lelang->delete();
            flash()->addSuccess('Lelang berhasil dihapus!', 'Sukses');
        } catch (QueryException $e) {
            flash()->addError('Data ini masih digunakan di history lelang.', 'Gagal');
        }
        return redirect()->back();
    }
}
