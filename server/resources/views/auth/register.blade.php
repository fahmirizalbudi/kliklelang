@extends('layouts.guest')
@section('title', 'KlikLelang - Register')

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/pages/register/style.css') }}">
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
          <span class="register-form-inner-description-text">Lengkapi data pendaftaran Anda untuk membuat akun KlikLelang.
            Akun ini akan digunakan untuk mengikuti proses lelang.</span>
        </div>
        <div class="register-form-inner-body">
          <form method="POST" action="{{ route('register') }}" class="register-form-inner-body-action">
            @csrf
            <x-text-field-group>
              <x-text-field-label text="Nama Lengkap" for="nama_lengkap" required></x-text-field-label>
              <x-text-field placeholder="Masukkan name lengkap anda ..." name="nama_lengkap"
                :defaultValue="old('nama_lengkap')"></x-text-field>
            </x-text-field-group>
            <x-text-field-group>
              <x-text-field-label text="No Induk (NIK)" for="username" required></x-text-field-label>
              <x-text-field placeholder="Masukkan no induk anda ..." name="username" :defaultValue="old('username')"
                max="16"></x-text-field>
            </x-text-field-group>
            <x-text-field-group>
              <x-text-field-label text="Password" for="password" required></x-text-field-label>
              <x-text-field placeholder="Masukkan password anda ..." type="password" name="password"
                :defaultValue="old('password')"></x-text-field>
            </x-text-field-group>
            <x-text-field-group>
              <x-text-field-label text="Telepon" for="telp" required></x-text-field-label>
              <x-text-field type="tel" placeholder="Masukkan telepon anda ..." name="telp"
                :defaultValue="old('telp')"></x-text-field>
            </x-text-field-group>
            <x-text-field-group>
              <x-text-field-label text="Alamat" for="alamat" required></x-text-field-label>
              <x-text-field type="text" placeholder="Masukkan alamat anda ..." name="alamat"
                :defaultValue="old('alamat')"></x-text-field>
            </x-text-field-group>
            <button type="submit" class="register-button">
              Register
            </button>
          </form>
        </div>
      </div>
      <div class="register-form-inner-2">
        <a href="{{ route('login.view.masyarakat') }}" class="register-as">
          Log In sebagai Masyarakat
        </a>
      </div>
    </div>
    <div class="register-illustration">
      <img class="register-illustration-image" src="{{ asset('assets/images/bid-illustration.png') }}"
        alt="Ilustrasi Pelelangan">
    </div>
  </section>
@endsection