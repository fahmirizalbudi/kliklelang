@extends('layouts.guest')
@section('title', 'KlikLelang - Register')

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/pages/register/style.css') }}">
  <link rel="stylesheet" href="{{ asset('css/components/message.css') }}">
  <link rel="stylesheet" href="{{ asset('css/components/text-field.css') }}">
  <link rel="stylesheet" href="{{ asset('css/components/label-field.css') }}">
@endpush

@section('content')
  <section class="register">
    <div class="register-form">
      <div class="register-form-inner">
        <a href="#" class="brand-link">
          <img src="{{ asset('brand.svg') }}" alt="KlikLelang" width="32" class="register-brand-logo">
          <span class="register-brand-text">KlikLelang</span>
        </a>
        <div class="register-form-inner-header">
          <h1 class="register-form-inner-header-text">Register
          </h1>
          <span class="register-form-inner-description-text">Lengkapi data pendaftaran untuk membuat akun
            KlikLelang.</span>
        </div>
        <div class="register-form-inner-body">
          <form method="POST" action="{{ route('register') }}" class="register-form-inner-body-action">
            @csrf
            <div>
              <x-label-field forField="nama_lengkap">Nama Lengkap</x-label-field>
              <x-text-field placeholder="Masukkan nama lengkap" name="nama_lengkap"
                :defaultValue="old('nama_lengkap')"></x-text-field>
              @error('nama_lengkap')
                <x-message asError text="{{ $message }}"></x-message>
              @enderror
            </div>
            <div>
              <x-label-field forField="username">Username</x-label-field>
              <x-text-field placeholder="Masukkan username" name="username"
                :defaultValue="old('username')"></x-text-field>
              @error('username')
                <x-message asError text="{{ $message }}"></x-message>
              @enderror
            </div>
            <div>
              <x-label-field forField="nik">No Induk (NIK)</x-label-field>
              <x-text-field placeholder="Masukkan no induk (NIK)" name="nik" :defaultValue="old('nik')"
                type="tel"></x-text-field>
              @error('nik')
                <x-message asError text="{{ $message }}"></x-message>
              @enderror
            </div>
            <div>
              <x-label-field forField="password">Password</x-label-field>
              <x-text-field placeholder="Masukkan password" type="password" name="password"
                :defaultValue="old('password')"></x-text-field>
              @error('password')
                <x-message asError text="{{ $message }}"></x-message>
              @enderror
            </div>
            <div>
              <x-label-field forField="password_confirmation">Konfirmasi Password</x-label-field>
              <x-text-field placeholder="Masukkan konfirmasi password" type="password" name="password_confirmation"
                :defaultValue="old('password_confirmation')"></x-text-field>
            </div>
            <div>
              <x-label-field forField="telp">Telepon</x-label-field>
              <x-text-field type="tel" placeholder="Masukkan telepon" name="telp"
                :defaultValue="old('telp')"></x-text-field>
              @error('telp')
                <x-message asError text="{{ $message }}"></x-message>
              @enderror
            </div>
            <div>
              <x-label-field forField="alamat">Alamat</x-label-field>
              <x-text-field type="text" placeholder="Masukkan alamat" name="alamat"
                :defaultValue="old('alamat')"></x-text-field>
              @error('alamat')
                <x-message asError text="{{ $message }}"></x-message>
              @enderror
            </div>
            <button type="submit" class="register-button">
              Register
            </button>
          </form>
        </div>
      </div>
      <div class="register-form-inner-2">
        <a href="{{ route('login.view') }}" class="register-as">
          Sudah punya akun? Log In
        </a>
      </div>
    </div>
    <div class="register-illustration">
      <img class="register-illustration-image" src="{{ asset('assets/images/bid-illustration.png') }}"
        alt="Ilustrasi Pelelangan">
    </div>
  </section>
@endsection