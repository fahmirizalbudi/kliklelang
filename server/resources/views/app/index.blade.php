@extends('layouts.app')

@section('title', 'KlikLelang - Beranda')

@section('content')
  <section class="beranda">
    <div class="hero-section">
      <h1 class="hero-title">Platform Lelang Online untuk Semua Orang</h1>
      <p class="hero-text">
        KlikLelang menghadirkan pengalaman lelang online yang cepat, aman, dan transparan untuk semua pengguna. Temukan
        barang menarik, ikuti penawaran real-time, dan menangkan lelang dengan mudah. Mulai perjalanan lelangmu sekarang
        dan rasakan kemudahannya.
      </p>
      <div class="hero-ctas">
        <button class="hero-cta mulai-lelang">Mulai Lelang</button>
        <button class="hero-cta pelajari-fitur">Pelajari Fitur</button>
      </div>
    </div>
  </section>
@endsection

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/pages/app/index.css') }}">
@endpush