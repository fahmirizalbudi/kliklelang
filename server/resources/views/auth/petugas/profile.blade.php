@extends('layouts.petugas')

@section('title', 'KlikLelang - Profil Pengguna')

@section('content')
  @php
    $petugas = auth()->guard('petugas')->user();
  @endphp
  <div class="profile-petugas">
    <x-breadcrumb groupPage="Beranda" currentPage="Profil Pengguna"></x-breadcrumb>
    <section>
      <form action="{{ route('auth.petugas.update', $petugas) }}" method="POST" class="petugas-form" novalidate>
        @csrf
        @method('PUT')
        <x-form-card title="Informasi Pengguna">
          <div class="petugas-info-form">
            <div class="petugas-name">
              <x-label-field forField="nama_petugas">Nama Petugas</x-label-field>
              <x-text-field placeholder="Masukkan nama petugas" type="text" name="nama_petugas"
                defaultValue="{{ $petugas->nama_petugas }}"></x-text-field>
              @error('nama_petugas')
                <x-message asError text="{{ $message }}"></x-message>
              @enderror
            </div>
          </div>
        </x-form-card>
        <x-form-card title="Akun Pengguna">
          <div class="petugas-akun-form">
            <div class="petugas-username">
              <x-label-field forField="username">Username</x-label-field>
              <x-text-field placeholder="Masukkan username" type="text" name="username"
                defaultValue="{{ $petugas->username }}"></x-text-field>
              @error('username')
                <x-message asError text="{{ $message }}"></x-message>
              @enderror
            </div>
            <div>
              <x-label-field forField="password">Password</x-label-field>
              <x-text-field placeholder="Masukkan password" type="password" name="password"></x-text-field>
              <x-message asInfo text="Kosongkan password jika tidak ingin mengubahnya."></x-message>
            </div>
            <div>
              <x-label-field forField="password_confirmation">Konfirmasi Password</x-label-field>
              <x-text-field placeholder="Masukkan konfirmasi password" type="password" name="password_confirmation"
                defaultValue="{{ old('password_confirmation') }}"></x-text-field>
              @error('password')
                <x-message asError text="{{ $message }}"></x-message>
              @enderror
            </div>
          </div>
        </x-form-card>
        <div class="petugas-form-actions">
          <button class="submit-button" type="submit">Perbarui Profil</button>
        </div>
      </form>
    </section>
  </div>
@endsection

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/pages/profile/petugas/style.css') }}">
@endpush