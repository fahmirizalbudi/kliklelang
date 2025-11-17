@extends('layouts.petugas')
@section('title', 'KlikLelang - Tambah Masyarakat')

@section('content')
  <div class="tambah-masyarakat">
    <x-breadcrumb groupPage="Masyarakat" currentPage="Tambah Masyarakat"></x-breadcrumb>
    <section>
      <form action="{{ route('masyarakat.store') }}" method="POST" class="masyarakat-form">
        @csrf
        <x-form-card title="Informasi Masyarakat">
          <div class="masyarakat-info-form">
            <div>
              <x-label-field forField="nama_lengkap">Nama Lengkap</x-label-field>
              <x-text-field placeholder="Masukkan nama lengkap" type="text" name="nama_lengkap"
                defaultValue="{{ old('nama_lengkap') }}"></x-text-field>
              @error('nama_lengkap')
                <x-message asError text="{{ $message }}"></x-message>
              @enderror
            </div>
            <div>
              <x-label-field forField="telp">Telepon</x-label-field>
              <x-text-field placeholder="Masukkan telepon" type="tel" name="telp"
                defaultValue="{{ old('telp') }}"></x-text-field>
              @error('telp')
                <x-message asError text="{{ $message }}"></x-message>
              @enderror
            </div>
            <div class="alamat-masyarakat-group">
              <x-label-field forField="masyarakat">Alamat</x-label-field>
              <textarea name="alamat" rows="7" id="alamat" placeholder="Masukkan alamat">{{ old('alamat') }}</textarea>
              @error('alamat')
                <x-message asError text="{{ $message }}"></x-message>
              @enderror
            </div>
          </div>
        </x-form-card>
        <x-form-card title="Akun Masyarakat">
          <div class="masyarakat-akun-form">
            <div>
              <x-label-field forField="username">Username</x-label-field>
              <x-text-field placeholder="Masukkan username" type="text" name="username"
                defaultValue="{{ old('username') }}"></x-text-field>
              @error('username')
                <x-message asError text="{{ $message }}"></x-message>
              @enderror
            </div>
            <div>
              <x-label-field forField="password">Password</x-label-field>
              <x-text-field placeholder="Masukkan password" type="password" name="password"
                defaultValue="{{ old('password') }}"></x-text-field>
              @error('password')
                <x-message asError text="{{ $message }}"></x-message>
              @enderror
            </div>
          </div>
        </x-form-card>
        <div class="masyarakat-form-actions">
          <button class="submit-button" type="submit">Simpan Masyarakat</button>
        </div>
      </form>
    </section>
  </div>
@endsection

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/pages/dashboard/masyarakat/style.css') }}">
@endpush