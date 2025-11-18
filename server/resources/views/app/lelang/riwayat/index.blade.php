@extends('layouts.app')
@section('title', 'KlikLelang - Lelang')

@section('content')
  <section id="riwayat-lelang">
    <header class="riwayat-lelang-header">
      <h2 class="riwayat-lelang-header-text">Riwayat Lelang Anda</h2>
    </header>
    <div class="riwayat-lelang-barang-container">
      <ul class="riwayat-lelang-barang-list">
        @foreach ($daftarLelang as $lelang)
          @include('app.lelang.riwayat.includes.card')
        @endforeach
      </ul>
    </div>
  </section>
@endsection

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/pages/app/lelang/riwayat/style.css') }}">
@endpush