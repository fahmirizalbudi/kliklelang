@extends('layouts.app')
@section('title', 'KlikLelang - Segera Hadir')

@section('content')
  <section id="incoming-lelang">
    <header class="incoming-lelang-header">
      <h2 class="incoming-lelang-header-text">Lelang Segera Hadir</h2>
    </header>
    <div class="incoming-lelang-barang-container">
      <ul class="incoming-lelang-barang-list">
        @foreach ($daftarLelang as $lelang)
          @include('app.lelang.incoming.includes.card')
        @endforeach
      </ul>
    </div>
  </section>
@endsection

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/pages/app/lelang/incoming/style.css') }}">
@endpush