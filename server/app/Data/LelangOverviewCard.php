<?php

namespace App\Data;

use App\Models\HistoryLelang;
use App\Models\Lelang;

class LelangOverviewCard
{
  public function items()
  {
    $lelangIsOpened = Lelang::where('status', 'dibuka')->count();
    $lelangBidTotal = HistoryLelang::whereDate('created_at', today())->count();
    $barangLelangIsNotSale = Lelang::where('harga_akhir', null)->count();
    $highBidOffer = HistoryLelang::whereDate('created_at', today())->max('penawaran_harga');

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
