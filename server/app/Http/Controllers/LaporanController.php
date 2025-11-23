<?php

namespace App\Http\Controllers;

use App\Models\Lelang;
use App\Models\Petugas;
use Auth;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function aktivitas(Request $request)
    {
        $daftarLelang = Lelang::with('barang', 'masyarakat');

        $mulai = $request->input('mulai');
        $sampai = $request->input('sampai');
        $search = $request->input('search');

        if (Auth::guard('petugas')->user()->level->level === 'administrator') {
            $petugas = $request->input('petugas');
            if (isset($petugas)) {
                $daftarLelang->where('id_petugas', $petugas);
            }
        } else {
            $daftarLelang->where('id_petugas', Auth::guard('petugas')->id());
        }

        $daftarLelang->when($mulai, function ($query) use ($mulai) {
            $query->whereDate('tgl_lelang', '>=', $mulai);
        })->when($sampai, function ($query) use ($sampai) {
            $query->whereDate('tgl_lelang', '<=', $sampai);
        });

        $daftarLelang->where(function ($query) use ($search) {
            $query->whereHas('masyarakat', function ($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%$search%");
            })
                ->orWhereHas('barang', function ($q) use ($search) {
                    $q->where('nama_barang', 'like', "%$search%");
                });
        });

        $status = $request->input('status');

        if ($status === 'dibuka') {
            $daftarLelang->where('status', 'dibuka');
        } elseif ($status === 'ditutup') {
            $daftarLelang->where('status', 'ditutup')->whereNull('id_user');
        } elseif ($status === 'selesai') {
            $daftarLelang->where('status', 'ditutup')->whereNotNull('id_user');
        }

        $daftarPetugas = Petugas::whereHas('level', function ($query) {
            $query->where('level', 'petugas');
        })->get();

        $daftarLelang = $daftarLelang->paginate(7);

        return view('dashboard.laporan.aktivitas', compact('daftarLelang', 'daftarPetugas'));
    }

    public function aktivitasExport(Request $request)
    {
        $daftarLelang = Lelang::with('barang', 'masyarakat');

        $mulai = $request->input('mulai');
        $sampai = $request->input('sampai');
        $search = $request->input('search');

        if (Auth::guard('petugas')->user()->level->level === 'administrator') {
            $petugas = $request->input('petugas');
            if (isset($petugas)) {
                $daftarLelang->where('id_petugas', $petugas);
            }
        } else {
            $daftarLelang->where('id_petugas', Auth::guard('petugas')->id());
        }

        $daftarLelang->when($mulai, function ($query) use ($mulai) {
            $query->whereDate('tgl_lelang', '>=', $mulai);
        })->when($sampai, function ($query) use ($sampai) {
            $query->whereDate('tgl_lelang', '<=', $sampai);
        });

        $daftarLelang->where(function ($query) use ($search) {
            $query->whereHas('masyarakat', function ($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%$search%");
            })
                ->orWhereHas('barang', function ($q) use ($search) {
                    $q->where('nama_barang', 'like', "%$search%");
                });
        });

        $status = $request->input('status');

        if ($status === 'dibuka') {
            $daftarLelang->where('status', 'dibuka');
        } elseif ($status === 'ditutup') {
            $daftarLelang->where('status', 'ditutup')->whereNull('id_user');
        } elseif ($status === 'selesai') {
            $daftarLelang->where('status', 'ditutup')->whereNotNull('id_user');
        }

        $daftarLelang = $daftarLelang->get();

        $pdf = Pdf::loadView('dashboard.laporan.template.aktivitas', compact('daftarLelang'));
        $pdf->setPaper('A4', 'landscape');

        return $pdf->stream('laporan-aktivitas.pdf');
    }

    public function pemenang(Request $request)
    {
        $daftarPemenang = Lelang::with('barang', 'masyarakat');

        $mulai = $request->input('mulai');
        $sampai = $request->input('sampai');
        $search = $request->input('search');

        if (Auth::guard('petugas')->user()->level->level === 'administrator') {
            $petugas = $request->input('petugas');
            $daftarPemenang = Lelang::whereNotNull('id_user');
            if (isset($petugas)) {
                $daftarPemenang->where('id_petugas', $petugas);
            }
        } else {
            $daftarPemenang->whereNotNull('id_user')->where('id_petugas', Auth::guard('petugas')->id());
        }

        $daftarPemenang->when($mulai, function ($query) use ($mulai) {
            $query->whereDate('tgl_lelang', '>=', $mulai);
        })->when($sampai, function ($query) use ($sampai) {
            $query->whereDate('tgl_lelang', '<=', $sampai);
        });

        $daftarPemenang->where(function ($query) use ($search) {
            $query->whereHas('masyarakat', function ($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%$search%");
            })
                ->orWhereHas('barang', function ($q) use ($search) {
                    $q->where('nama_barang', 'like', "%$search%");
                });
        });

        $daftarPetugas = Petugas::whereHas('level', function ($query) {
            $query->where('level', 'petugas');
        })->get();

        $daftarPemenang = $daftarPemenang->paginate(7);

        return view('dashboard.laporan.pemenang', compact('daftarPemenang', 'daftarPetugas'));
    }

    public function pemenangExport(Request $request)
    {
        $daftarPemenang = $daftarPemenang = Lelang::whereNotNull('id_user')->where('id_petugas', Auth::guard('petugas')->id());

        $mulai = $request->input('mulai');
        $sampai = $request->input('sampai');
        $search = $request->input('search');

        if (Auth::guard('petugas')->user()->level->level === 'administrator') {
            $petugas = $request->input('petugas');

            $daftarPemenang = Lelang::whereNotNull('id_user');
            if (isset($petugas)) {
                $daftarPemenang->where('id_petugas', $petugas);
            }
        }

        $daftarPemenang->when($mulai, function ($query) use ($mulai) {
            $query->whereDate('tgl_lelang', '>=', $mulai);
        })->when($sampai, function ($query) use ($sampai) {
            $query->whereDate('tgl_lelang', '<=', $sampai);
        });

        $daftarPemenang->where(function ($query) use ($search) {
            $query->whereHas('masyarakat', function ($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%$search%");
            })
                ->orWhereHas('barang', function ($q) use ($search) {
                    $q->where('nama_barang', 'like', "%$search%");
                });
        });

        $daftarPemenang = $daftarPemenang->get();

        $pdf = Pdf::loadView('dashboard.laporan.template.pemenang', compact('daftarPemenang'));
        $pdf->setPaper('A4', 'landscape');

        return $pdf->stream('laporan-pemenang.pdf');
    }
}
