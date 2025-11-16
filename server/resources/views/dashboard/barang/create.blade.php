@extends('layouts.petugas')
@section('title', 'KlikLelang - Tambah Barang')

@section('content')
  <div class="tambah-barang">
    <x-breadcrumb groupPage="Barang" currentPage="Tambah Barang"></x-breadcrumb>
    <section>
      <form action="{{ route('barang.store') }}" method="POST" class="barang-form" enctype="multipart/form-data">
        @csrf
        <x-form-card title="Informasi Barang">
          <div class="barang-info-form">
            <div>
              <x-label-field forField="nama_barang">Nama Barang</x-label-field>
              <x-text-field placeholder="Masukkan nama barang" type="text" name="nama_barang"></x-text-field>
            </div>
            <div>
              <x-label-field forField="harga_awal">Harga Awal</x-label-field>
              <x-text-field placeholder="12000" type="number" name="harga_awal"></x-text-field>
            </div>
            <div class="deskripsi-barang-group">
              <x-label-field forField="deskripsi_barang">Deskripsi Barang</x-label-field>
              <textarea name="deskripsi_barang" rows="7" id="deskripsi-barang"
                placeholder="Deskripsikan barang ini dengan detail" required></textarea>
            </div>
          </div>
        </x-form-card>
        <x-form-card title="Foto Barang">
          <label for="foto-barang" class="upload-foto-barang">
            <div class="upload-foto-barang-inner">
              <div class="upload-foto-barang-inner-box">
                <div class="upload-foto-barang-inner-box-icon">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path
                      d="M20.0004 16V18.5C20.0004 19.3284 19.3288 20 18.5004 20H5.49951C4.67108 20 3.99951 19.3284 3.99951 18.5V16M12.0015 4L12.0015 16M7.37454 8.6246L11.9994 4.00269L16.6245 8.6246"
                      stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                  </svg>
                </div>
                <p class="upload-foto-barang-inner-box-label">
                  <span class="click-to-upload">Klik untuk mengunggah</span>
                  atau pilih file gambar (SVG, PNG, JPG, GIF)
                </p>
              </div>
            </div>
            <input type="file" name="foto_barang" id="foto-barang"
              style="opacity: 0; position: absolute; top: 45%; left: 46%" required>
          </label>
        </x-form-card>
        <div class="barang-form-actions">
          <button class="submit-button" type="submit">Simpan Barang</button>
        </div>
      </form>
    </section>
  </div>
@endsection

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/pages/dashboard/barang/style.css') }}">
@endpush

@push('scripts')
  <script>
    const textBanner = document.querySelector('.upload-foto-barang-inner-box-label')
    document.getElementById('foto-barang').addEventListener('change', e => {
      textBanner.innerHTML = event.target.files[0].name
    })
  </script>
@endpush