<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\HistoryLelang;
use App\Models\Lelang;
use App\Models\Masyarakat;
use App\Models\Petugas;
use Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke()
    {
        $petugasLevel = Auth::guard('petugas')->user()->level->level;
        $petugasId = Auth::guard('petugas')->id();
        $view = null;
        $overviewItems = null;
        $barangCount = Barang::count();
        $penawaranTerakhir = null;
        if ($petugasLevel === 'petugas') {
            $view = 'dashboard.index.petugas';
            $lelangIsOpened = Lelang::where('status', 'dibuka')->where('id_petugas', $petugasId)->count();
            $lelangBidTotal = HistoryLelang::whereDate('created_at', today())->whereHas('lelang', function ($query) use ($petugasId) {
                $query->where('id_petugas', $petugasId);
            })->count();
            $lelangFinish = Lelang::whereNotNull('id_user')->where('id_petugas', $petugasId)->count();
            $overviewItems = [
                [
                    'title' => 'Total Lelang Dibuka',
                    'value' => $lelangIsOpened,
                ],
                [
                    'title' => 'Total Penawaran Hari Ini',
                    'value' => $lelangBidTotal,
                ],
                [
                    'title' => 'Total Barang Terdafar',
                    'value' => $barangCount,
                ],
                [
                    'title' => 'Total Lelang Selesai',
                    'value' => $lelangFinish,
                ]
            ];
            $penawaranTerakhir = HistoryLelang::whereHas('lelang', function ($query) use ($petugasId) {
                $query->where('id_petugas', $petugasId);
            })->orderBy('created_at', 'desc')->limit(5)->get();
        } elseif ($petugasLevel === 'administrator') {
            $totalMasyarakat = Masyarakat::count();
            $totalPetugas = Petugas::whereHas('level', function ($query) {
                $query->where('level', 'petugas');
            })->count();
            $totalMasyarakatBlock = Masyarakat::where('status', 'blokir')->count();
            $overviewItems = [
                [
                    'title' => 'Total Masyarakat Terdaftar',
                    'value' => $totalMasyarakat,
                ],
                [
                    'title' => 'Total Petugas Lelang',
                    'value' => $totalPetugas,
                ],
                [
                    'title' => 'Total Barang Terdafar',
                    'value' => $barangCount,
                ],
                [
                    'title' => 'Total Masyarakat Diblokir',
                    'value' => $totalMasyarakatBlock,
                ]
            ];
            $view = 'dashboard.index.administrator';
        }

        return view($view, compact('overviewItems', 'penawaranTerakhir'));
    }
}
