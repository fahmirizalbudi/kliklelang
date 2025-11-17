@extends('layouts.petugas')
@section('title', 'KlikLelang - Aktivasi Lelang')

@section('content')
  <div class="aktivasi-lelang">
    <x-breadcrumb groupPage="Lelang" currentPage="Aktivasi Lelang"></x-breadcrumb>
    <section>
      <form action="{{ route('lelang.activate') }}" method="POST" class="lelang-form" novalidate>
        @csrf
        <x-form-card title="Barang Lelang">
          <div class="lelang-barang-form">
            <div class="lelang-barang">
              <x-label-field forField="id_barang">Barang</x-label-field>
              <x-select-field name="id_barang" placeholder="Pilih barang" defaultValue="{{ old('id_barang') }}">
                @foreach ($daftarBarang as $barang)
                  <option value="{{ $barang->id_barang }}"
                    data-img="{{ asset('storage/foto_barang/' . $barang->foto_barang) }}">
                    {{ $barang->nama_barang }}
                  </option>
                @endforeach
              </x-select-field>
              @error('id_barang')
                <x-message asError text="{{ $message }}"></x-message>
              @enderror
            </div>
            <div>
              <x-label-field forField="tgl_lelang">Tanggal Lelang</x-label-field>
              <x-text-field placeholder="yyyy/mm/dd" defaultValue="{{ old('tgl_lelang') }}" type="date"
                name="tgl_lelang"></x-text-field>
              @error('tgl_lelang')
                <x-message asError text="{{ $message }}"></x-message>
              @enderror
            </div>
            <div>
              <x-label-field forField="tgl_lelang">Status</x-label-field>
              <x-select-field placeholder="Masukkan status" name="status" defaultValue="{{ old('status') }}">
                <option value="ditutup">Ditutup</option>
                <option value="dibuka">Dibuka</option>
              </x-select-field>
              @error('status')
                <x-message asError text="{{ $message }}"></x-message>
              @enderror
            </div>
          </div>
        </x-form-card>
        <div class="lelang-form-actions">
          <button class="submit-button" type="submit">Aktivasi Lelang</button>
        </div>
      </form>
    </section>
  </div>
@endsection

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/pages/dashboard/lelang/style.css') }}">
@endpush