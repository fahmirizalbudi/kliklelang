<?php

namespace App\Data;

use App\Models\HistoryLelang;
use App\Models\Lelang;

class LelangOverviewCard
{
  public function items($petugasId)
  {
    $lelangIsOpened = Lelang::where('status', 'dibuka')->where('id_petugas', $petugasId)->count();
    $lelangBidTotal = HistoryLelang::whereDate('created_at', today())->whereHas('lelang', function ($query) use ($petugasId) {
      $query->where('id_petugas', $petugasId);
    })->count();
    $barangLelangIsNotSale = Lelang::whereNull('harga_akhir')->where('status', 'ditutup')->where('id_petugas', $petugasId)->count();
    $highBidOffer = HistoryLelang::whereDate('created_at', today())->whereHas('lelang', function ($query) use ($petugasId) {
      $query->where('id_petugas', $petugasId);
    })->max('penawaran_harga');

    return [
      [
        'title' => 'Total Lelang Dibuka',
        'value' => $lelangIsOpened
      ],
      [
        'title' => 'Total Penawaran Hari Ini',
        'value' => $lelangBidTotal
      ],
      [
        'title' => 'Barang Lelang Belum Terjual',
        'value' => $barangLelangIsNotSale
      ],
      [
        'title' => 'Penawaran Tertinggi Hari Ini',
        'value' => $highBidOffer ? 'Rp ' . number_format($highBidOffer, 0, '.', '.') : 'Rp -'
      ],
    ];
  }
}
