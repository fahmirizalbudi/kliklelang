<!doctype html>
<html lang="id">

<head>
  <meta charset="utf-8">
  <title>Laporan Aktivitas Lelang</title>

  <style>
    * {
      box-sizing: border-box;
    }

    body {
      font-family: Arial, sans-serif;
      font-size: 12px;
      color: #000;
      margin: 0;
      padding: 0;
    }

    .header {
      text-align: center;
      margin-bottom: 15px;
    }

    .header img {
      width: 60px;
      margin-bottom: 8px;
    }

    .company-title {
      font-size: 18px;
      font-weight: bold;
      margin-bottom: 2px;
    }

    .company-sub {
      font-size: 11px;
      margin-bottom: 15px;
    }

    .title-big {
      text-align: center;
      font-size: 16px;
      font-weight: bold;
      margin: 15px 0;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin: 10px 0 20px 0;
    }

    th,
    td {
      border: 1px solid #000;
      padding: 6px;
      font-size: 11px;
      word-break: break-word;
    }

    th {
      background: #f1f1f1;
      font-weight: bold;
      text-align: center;
    }

    th:nth-child(1) {
      width: 5%;
    }

    .text {
      font-size: 12px;
      margin-top: 10px;
      text-align: justify
    }

    .ttd-area {
      width: 100%;
      position: relative;
      left: 75%;
      margin-top: 40px;
    }

    .ttd {
      width: 180px;
      text-align: center;
      font-size: 12px;
    }

    .ttd .name {
      margin-top: 55px;
      font-weight: bold;
      text-decoration: underline;
      font-size: 12px;
    }
  </style>
</head>

<body>
  <div class="page">

    <div class="header">
      {{-- <img src="{{ asset('brand.svg') }}" alt="Logo"> --}}
      <div class="company-title">KLIKLELANG</div>
      <div class="company-sub">
        Jl. Rekayasa Perangkat Lunak - www.kliklelang.example<br>
        @php
          $mulai = request('mulai');
          $selesai = request('selesai');
        @endphp

        Tanggal:
        {{ $mulai ? \Carbon\Carbon::parse($mulai)->translatedFormat('l, d F Y') : '-' }}
        s.d
        {{ $selesai ? \Carbon\Carbon::parse($selesai)->translatedFormat('l, d F Y') : '-' }}

      </div>
    </div>

    <div class="title-big">LAPORAN AKTIVITAS LELANG</div>

    <table>
      <thead>
        @if (Auth::guard('petugas')->user()->level->level === 'administrator')
          <tr>
            <td colspan="8" style="font-weight: bold">

              @if (request()->filled('petugas'))
                Petugas: {{ \App\Models\Petugas::find(request()->input('petugas'))->nama_petugas }}
              @else
                Petugas: Semua Petugas
              @endif

            </td>
          </tr>
        @else
          <tr>
            <td colspan="8" style="font-weight: bold">
              Petugas: {{ Auth::guard('petugas')->user()->nama_petugas }}
            </td>
          </tr>
        @endif

        <tr>
          <th>No</th>
          <th>Tanggal Lelang</th>
          <th>Petugas</th>
          <th>Barang</th>
          <th>Harga Awal</th>
          <th>Pemenang</th>
          <th>Harga Akhir</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        @php
          $totalHargaAkhir = 0;
        @endphp
        @foreach ($daftarLelang as $lelang)
          @php
            if ($lelang->harga_akhir !== null) {
              $totalHargaAkhir += $lelang->harga_akhir;
            }
            $statusnya = null;
            if ($lelang->status === 'dibuka') {
              $statusnya = 'dibuka';
            } elseif ($lelang->status === 'ditutup' && $lelang->id_user === null) {
              $statusnya = 'ditutup';
            } elseif ($lelang->status === 'ditutup' && $lelang->historyLelang->count() > 0 && $lelang->id_user) {
              $statusnya = 'selesai';
            }
          @endphp
          <tr>
            <td style="text-align:center;">{{ $loop->iteration }}</td>
            <td>{{ $lelang->tgl_lelang }}</td>
            <td>{{ $lelang->petugas->nama_petugas }}</td>
            <td>{{ $lelang->barang->nama_barang }}</td>
            <td>Rp {{ number_format($lelang->barang->harga_awal, 0, ',', '.') }}</td>
            <td>{{ $lelang->masyarakat ? $lelang->masyarakat->nama_lengkap : '-' }}</td>
            <td>Rp {{ $lelang->harga_akhir ? number_format($lelang->harga_akhir, 0, ',', '.') : '-' }}</td>
            <td style="text-transform: capitalize">{{ $statusnya }}</td>
          </tr>
        @endforeach
        <tr>
          <td colspan="7" style="text-align:right; font-weight:bold;">TOTAL</td>
          <td style="font-weight:bold;">
            Rp {{ number_format($totalHargaAkhir, 0, ',', '.') }}
          </td>
        </tr>
      </tbody>
    </table>

    <p class="text">
      Demikian laporan hasil pelaksanaan lelang yang telah dilaksanakan.
      Data pada tabel di atas merupakan hasil final dari proses lelang.
    </p>

    {{-- <div class="ttd-area">
      <div class="ttd">
        Pejabat Lelang<br>
        <div class="name">(Fahmirizal Budi Ramadhan)</div>
      </div>
    </div> --}}

  </div>
</body>

</html>