@extends('layouts.guest')
@section('title', 'KlikLelang - Log In ' . (request()->is('auth/login/petugas') ? 'Petugas' : 'Masyarakat'))

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/pages/login/style.css') }}">
@endpush

@section('content')
  <section class="login">
    <div class="login-form">
      <div class="login-form-inner">
        <a href="#" class="brand-link">
          <img src="{{ asset('brand.svg') }}" alt="KlikLelang" width="32" class="login-brand-logo">
          <span class="login-brand-text">KlikLelang</span>
        </a>
        <div class="login-form-inner-header">
          <h1 class="login-form-inner-header-text">Log In
            {{ request()->is('auth/login/petugas') ? 'Petugas' : 'Masyarakat' }}
          </h1>
          <span
            class="login-form-inner-description-text">{{ !request()->is('auth/login/petugas') ? 'Silahkan log in untuk melanjutkan ke dalam sistem aplikasi lelang online.' : 'Silahkan log in sebagai admin/petugas untuk mengatur sistem dan pengguna aplikasi lelang.' }}</span>
        </div>
        <div class="login-form-inner-body">
          <form method="POST"
            action="{{ route(request()->is('auth/login/petugas') ? 'login.petugas' : 'login.masyarakat') }}"
            class="login-form-inner-body-action">
            @csrf
            <x-text-field-group>
              <x-text-field-label text="Username" for="username" required></x-text-field-label>
              <x-text-field icon="username" placeholder="Masukkan username anda ..." name="username"
                :defaultValue="old('username')"></x-text-field>
            </x-text-field-group>
            <x-text-field-group>
              <x-text-field-label text="Password" for="password" required></x-text-field-label>
              <x-text-field icon="password" placeholder="Masukkan password anda ..." type="password" name="password"
                :defaultValue="old('password')"></x-text-field>
            </x-text-field-group>
            <button type="submit" class="login-button">
              Log In
            </button>
          </form>
        </div>
      </div>
      <div class="login-form-inner-2">
        <a href="{{ route(request()->is('auth/login/petugas') ? 'login.view.masyarakat' : 'login.view.petugas') }}"
          class="login-as">
          Log In sebagai {{ request()->is('auth/login/petugas') ? 'Masyarakat' : 'Petugas' }}
        </a>
      </div>
    </div>
    <div class="login-illustration">
      <img class="login-illustration-image" src="{{ asset('assets/images/bid-illustration.png') }}"
        alt="Ilustrasi Pelelangan">
    </div>
  </section>
@endsection