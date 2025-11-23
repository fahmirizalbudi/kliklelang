@extends('layouts.app')

@section('title', 'KlikLelang - Beranda')

@section('content')
  <section class="beranda-container">

    <div class="hero-section">
      <div class="hero-content">
        <h1 class="hero-title">Platform Lelang Online untuk Semua Orang</h1>
        <p class="hero-text">
          KlikLelang menghadirkan pengalaman lelang online yang cepat, aman, dan transparan untuk semua pengguna. Temukan
          barang menarik, ikuti penawaran real-time, dan menangkan lelang dengan mudah.
        </p>
        <div class="hero-ctas">
          <button class="hero-cta mulai-lelang">Mulai Lelang</button>
          <button class="hero-cta pelajari-fitur">Pelajari Fitur</button>
        </div>
      </div>
      <div class="hero-image">
        <img src="{{ asset('assets/images/illustration-2.png') }}" alt="Ilustrasi Lelang Online">
      </div>
    </div>

    <section class="features-section">
      <h2 class="section-title">Kenapa Memilih KlikLelang?</h2>
      <div class="features-grid">

        <div class="feature-card">
          <div class="feature-icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
              <path fill-rule="evenodd"
                d="M12 1.5a5.25 5.25 0 00-5.25 5.25v3a3 3 0 00-3 3v6.75a3 3 0 003 3h10.5a3 3 0 003-3v-6.75a3 3 0 00-3-3v-3c0-2.9-2.35-5.25-5.25-5.25zm3.75 8.25v-3a3.75 3.75 0 10-7.5 0v3h7.5z"
                clip-rule="evenodd" />
            </svg>
          </div>
          <h3 class="feature-title">Aman & Terpercaya</h3>
          <p class="feature-description">
            Sistem verifikasi dan transaksi yang aman menjamin setiap lelang berjalan lancar tanpa khawatir.
          </p>
        </div>

        <div class="feature-card">
          <div class="feature-icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
              <path fill-rule="evenodd"
                d="M10.5 3.75a6.75 6.75 0 100 13.5 6.75 6.75 0 000-13.5zM2.25 10.5a8.25 8.25 0 1114.59 5.28l4.69 4.69a.75.75 0 11-1.06 1.06l-4.69-4.69A8.25 8.25 0 012.25 10.5z"
                clip-rule="evenodd" />
            </svg>
          </div>
          <h3 class="feature-title">Pilihan Beragam</h3>
          <p class="feature-description">
            Temukan berbagai kategori barang, mulai dari elektronik, fashion, hingga koleksi langka dengan harga
            kompetitif.
          </p>
        </div>

        <div class="feature-card">
          <div class="feature-icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
              <path d="M1.5 8.67v8.58a3 3 0 003 3h15a3 3 0 003-3V8.67l-8.928 5.493a3 3 0 01-3.144 0L1.5 8.67z" />
              <path d="M22.5 6.908V6.75a3 3 0 00-3-3h-15a3 3 0 00-3 3v.158l9.714 5.978a1.5 1.5 0 001.572 0L22.5 6.908z" />
            </svg>
          </div>
          <h3 class="feature-title">Proses Transparan</h3>
          <p class="feature-description">
            Ikuti setiap penawaran secara real-time. Tidak ada biaya tersembunyi dan proses yang ditutup-tutupi.
          </p>
        </div>

      </div>
    </section>

  </section>
@endsection

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/pages/app/index.css') }}">
@endpush