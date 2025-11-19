@extends('layouts.app')
@section('title', 'KlikLelang - Lelang')

@section('content')
  <section id="riwayat-lelang">
    <header class="riwayat-lelang-header">
      <h2 class="riwayat-lelang-header-text">Riwayat Lelang Anda</h2>
      <div class="status-filter">
        <button onclick="window.location.href='{{ request()->fullUrlWithQuery(['status' => '']) }}'"
          class="status-filter-button {{ request()->input('status') == '' ? 'active' : '' }}">
          Semua
        </button>
        <button onclick="window.location.href='{{ request()->fullUrlWithQuery(['status' => 'proses']) }}'"
          class="status-filter-button {{ request()->input('status') == 'proses' ? 'active' : '' }}">
          Proses
        </button>
        <button onclick="window.location.href='{{ request()->fullUrlWithQuery(['status' => 'menang']) }}'"
          class="status-filter-button {{ request()->input('status') == 'menang' ? 'active' : '' }}">
          Menang
        </button>
        <button onclick="window.location.href='{{ request()->fullUrlWithQuery(['status' => 'kalah']) }}'"
          class="status-filter-button {{ request()->input('status') == 'kalah' ? 'active' : '' }}">
          Kalah
        </button>
      </div>
    </header>
    <div class="riwayat-lelang-barang-container">
      <ul class="riwayat-lelang-barang-list">
        @foreach ($daftarLelang as $lelang)
          @php
            $userId = Auth::guard('masyarakat')->id();
            $highestBid = $lelang->historyLelang->max('penawaran_harga');
            $userBid = $lelang->historyLelang->where('id_user', $userId)->max('penawaran_harga');
          @endphp
          @include('app.lelang.riwayat.includes.card')
        @endforeach
      </ul>
    </div>
  </section>
@endsection

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/pages/app/lelang/riwayat/style.css') }}">
@endpush