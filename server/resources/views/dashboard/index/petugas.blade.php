@extends('layouts.petugas')
@section('title', 'KlikLelang - Beranda')

@section('content')
  <div class="beranda">
    @php
      $hour = (int) now()->format('H');
      $greeting = 'Selamat Datang';
      if ($hour >= 5 && $hour < 12) {
        $greeting = 'Selamat Pagi';
      } elseif ($hour >= 12 && $hour < 15) {
        $greeting = 'Selamat Siang';
      } elseif ($hour >= 15 && $hour < 18) {
        $greeting = 'Selamat Sore';
      } else {
        $greeting = 'Selamat Malam';
      }

      $namaUser = auth()->guard('petugas')->user()->nama_petugas;
      $roleUser = auth()->guard('petugas')->user()->level->level;
    @endphp

    <div class="welcome-header">
      <h1 class="welcome-title">{{ $greeting }}, {{ $namaUser }}!</h1>
      <p class="welcome-subtitle">
        Anda masuk sebagai <strong>{{ $roleUser }}</strong>. Semoga harimu menyenangkan!
      </p>
    </div>
    <x-overview-card title="Ringkasan" :items="$overviewItems"></x-overview-card>
    <x-data-table title="Penawaran Terakhir"
      description="Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae, neque!" :rowHeaders="['ID Lelang', 'Tanggal', 'Masyarakat', 'Penawaran Harga']" v2 withoutOptional withoutFooter>
      @foreach ($penawaranTerakhir as $penawaran)
        <x-cell>
          <p class="default-cell-text" style="color: #667085">{{ $loop->iteration }}</p>
        </x-cell>
        <x-cell>
          <p onclick="window.location.href = '{{ route('lelang.detail', $penawaran->lelang) }}'"
            class="default-cell-text idLelang" style="font-weight: 500">#{{ $penawaran->id_lelang }}</p>
        </x-cell>
        <x-cell>
          <p class="default-cell-text">{{ $penawaran->created_at->format('Y-m-d') }}</p>
        </x-cell>
        <x-cell>
          <p class="default-cell-text">{{ $penawaran->masyarakat->nama_lengkap }}</p>
        </x-cell>
        <x-cell>
          <p class="default-cell-text">Rp {{ number_format($penawaran->penawaran_harga, 0, '.', '.')}}</p>
        </x-cell>
      @endforeach
    </x-data-table>
  </div>
@endsection

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/pages/dashboard/style.css') }}">
@endpush