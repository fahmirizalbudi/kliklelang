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
  </div>
@endsection

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/pages/dashboard/style.css') }}">
@endpush