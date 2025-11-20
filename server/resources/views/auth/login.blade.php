@extends('layouts.guest')
@section('title', 'KlikLelang - Log In ')

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/pages/login/style.css') }}">
@endpush

@section('content')
  <section class="login">
    @if ($errors->any())
      @foreach ($errors->all() as $error)
        @php
          flash()->addError($error, 'Error');
        @endphp
      @endforeach
    @endif
    <div class="login-form">
      <div class="login-form-inner">
        <a href="#" class="brand-link">
          <img src="{{ asset('brand.svg') }}" alt="KlikLelang" width="32" class="login-brand-logo">
          <span class="login-brand-text">KlikLelang</span>
        </a>
        <div class="login-form-inner-header">
          <h1 class="login-form-inner-header-text">Log In
          </h1>
          <span class="login-form-inner-description-text">Silahkan log in untuk melanjutkan ke dalam sistem aplikasi
            lelang online.</span>
        </div>
        <div class="login-form-inner-body">
          <form method="POST" action="{{ route('login') }}" class="login-form-inner-body-action">
            @csrf
            <x-text-field-group>
              <x-text-field-label text="Username / No Induk (NIK)" for="username" required></x-text-field-label>
              <x-text-field icon="username" placeholder="Masukkan username atau nik anda ..." name="login"
                :defaultValue="old('login')"></x-text-field>
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
          {{-- <a href="{{ route('register.view') }}" class="register-link">
            Belum punya akun? Register
          </a> --}}
        </div>
      </div>
      <div class="login-form-inner-2">
        <a href="{{ route('register.view') }}" class="login-as">
          Belum punya akun? Register
        </a>
      </div>
    </div>
    <div class="login-illustration">
      <img class="login-illustration-image" src="{{ asset('assets/images/bid-illustration.png') }}"
        alt="Ilustrasi Pelelangan">
    </div>
  </section>
@endsection