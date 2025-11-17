@extends('layouts.app')
@section('title', 'KlikLelang - Lelang')

@section('content')
  <section id="lelang">
    <header class="lelang-header">
      <h2 class="lelang-header-text">Koleksi Barang Lelang</h2>
    </header>
    <div class="lelang-barang-container">
      <ul class="lelang-barang-list">
        @foreach ($daftarLelang as $lelang)
          @include('app.lelang.includes.card')
        @endforeach
      </ul>
    </div>
  </section>
@endsection

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/pages/app/lelang/style.css') }}">
@endpush