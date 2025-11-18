<?php

namespace App\Http\Controllers;

use App\Models\Lelang;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function pemenang()
    {
        $daftarPemenang = Lelang::whereNotNull('id_user')->paginate(7);
        return view('dashboard.laporan.pemenang', compact('daftarPemenang'));
    }

    public function pemenangExport()
    {
        $daftarPemenang = Lelang::whereNotNull('id_user')->get();
        $pdf = Pdf::loadView('dashboard.laporan.template.pemenang', compact('daftarPemenang'));
        // $pdf->setPaper('A4', 'portrait');

        return $pdf->stream('invoice.pdf');
    }
}
