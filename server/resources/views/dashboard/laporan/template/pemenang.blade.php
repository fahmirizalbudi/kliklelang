<!doctype html>
<html lang="id">

<head>
  <meta charset="utf-8">
  <title>Laporan Pemenang Lelang</title>

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
      table-layout: fixed;
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

    th:nth-child(2) {
      width: 15%;
    }

    th:nth-child(3) {
      width: 15%;
    }

    th:nth-child(4) {
      width: 20%;
    }

    th:nth-child(5) {
      width: 15%;
    }

    th:nth-child(6) {
      width: 15%;
    }

    th:nth-child(7) {
      width: 15%;
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

    <div class="title-big">LAPORAN PELAKSANAAN LELANG</div>

    <table>
      <thead>
        @if (Auth::guard('petugas')->user()->level->level === 'administrator')
          <tr>
            <td colspan="7" style="font-weight: bold">

              @if (request()->filled('petugas'))
                Petugas: {{ \App\Models\Petugas::find(request()->input('petugas'))->nama_petugas }}
              @else
                Petugas: Semua Petugas
              @endif

            </td>
          </tr>
        @else
          <tr>
            <td colspan="7" style="font-weight: bold">
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
        </tr>
      </thead>
      <tbody>
        @php
          $totalHargaAkhir = 0;
        @endphp
        @foreach ($daftarPemenang as $pemenang)
          @php
            if ($pemenang->harga_akhir !== null) {
              $totalHargaAkhir += $pemenang->harga_akhir;
            }
          @endphp
          <tr>
            <td style="text-align:center;">{{ $loop->iteration }}</td>
            <td>{{ $pemenang->tgl_lelang }}</td>
            <td>{{ $pemenang->petugas->nama_petugas }}</td>
            <td>{{ $pemenang->barang->nama_barang }}</td>
            <td>Rp {{ number_format($pemenang->barang->harga_awal, 0, ',', '.') }}</td>
            <td>{{ $pemenang->masyarakat ? $pemenang->masyarakat->nama_lengkap : '-' }}</td>
            <td>Rp {{ number_format($pemenang->harga_akhir, 0, ',', '.') }}</td>
          </tr>
        @endforeach
        <tr>
          <td colspan="6" style="text-align:right; font-weight:bold;">TOTAL</td>
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