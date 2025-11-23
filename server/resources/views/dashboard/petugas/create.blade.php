@extends('layouts.petugas')
@section('title', 'KlikLelang - Tambah Petugas')

@section('content')
  <div class="tambah-petugas">
    <x-breadcrumb groupPage="Petugas" currentPage="Tambah Petugas"></x-breadcrumb>
    <section>
      <form action="{{ route('petugas.store') }}" method="POST" class="petugas-form" novalidate>
        @csrf
        <x-form-card title="Informasi Petugas">
          <div class="petugas-info-form">
            <div class="petugas-name">
              <x-label-field forField="nama_petugas">Nama Petugas</x-label-field>
              <x-text-field placeholder="Masukkan nama petugas" type="text" name="nama_petugas"
                defaultValue="{{ old('nama_petugas') }}"></x-text-field>
              @error('nama_petugas')
                <x-message asError text="{{ $message }}"></x-message>
              @enderror
            </div>
          </div>
        </x-form-card>
        <x-form-card title="Akun Petugas">
          <div class="petugas-akun-form">
            <div class="petugas-username">
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
            <div>
              <x-label-field forField="password_confirmation">Konfirmasi Password</x-label-field>
              <x-text-field placeholder="Masukkan konfirmasi password" type="password" name="password_confirmation"
                defaultValue="{{ old('password_confirmation') }}"></x-text-field>
            </div>
            <div class="petugas-level">
              <x-label-field forField="id_level">Level</x-label-field>
              <x-select-field name="id_level" placeholder="Pilih level e.g (administrator, petugas)"
                defaultValue="{{ old('id_level') }}">
                @foreach ($daftarLevel as $level)
                  <option value="{{ $level->id_level }}">{{ $level->level }}</option>
                @endforeach
              </x-select-field>
              @error('id_level')
                <x-message asError text="{{ $message }}"></x-message>
              @enderror
            </div>
          </div>
        </x-form-card>
        <div class="petugas-form-actions">
          <button class="submit-button" type="submit">Simpan Petugas</button>
        </div>
      </form>
    </section>
  </div>
@endsection

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/pages/dashboard/petugas/style.css') }}">
@endpush