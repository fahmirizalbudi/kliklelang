@extends('layouts.petugas')
@section('title', 'KlikLelang - Barang')

@section('content')
  <div class="barang">
    <x-breadcrumb groupPage="Master Data" currentPage="Barang"></x-breadcrumb>
    <section>
      <x-data-table title="Daftar Barang"
        description="Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae, neque!"
        withAdd="{{ route('barang.create') }}" withAddText="Tambah Barang" :rowHeaders="['Barang', 'Tanggal', 'Harga Awal', 'Deskripsi', '']">
        @foreach ($daftarBarang as $barang)
          <x-row>
            <x-cell>
              <p class="default-cell-text" style="color: #667085">{{ $daftarBarang->firstItem() + $loop->index }}</p>
            </x-cell>
            <x-cell>
              <div class="barang-cell">
                <div class="barang-preview">
                  <img class="barang-preview-image" src="{{ asset('storage/foto_barang/' . $barang->foto_barang) }}"
                    alt="{{ $barang->nama_barang }}">
                </div>
                <span class="barang-text">{{ $barang->nama_barang }}</span>
              </div>
            </x-cell>
            <x-cell>
              <p class="default-cell-text">{{ $barang->tgl }}</p>
            </x-cell>
            <x-cell>
              <p class="default-cell-text">Rp {{ number_format($barang->harga_awal, 0, '.', '.') }}</p>
            </x-cell>
            <x-cell className="barang-description">
              <p class="default-cell-text"
                style="width: 100%; overflow: hidden; white-space: nowrap; text-overflow: ellipsis">
                {{ $barang->deskripsi_barang }}
              </p>
            </x-cell>
            <x-cell>
              <div class="barang-actions">
                <x-edit-action to="{{ route('barang.edit', $barang) }}"></x-edit-action>
                <x-delete-action actionTo="{{ route('barang.destroy', $barang) }}"></x-delete-action>
              </div>
            </x-cell>
          </x-row>
        @endforeach
        <x-slot name="footer">
          {{ $daftarBarang->links('components.pagination') }}
        </x-slot>
      </x-data-table>
    </section>
  </div>
@endsection

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/pages/petugas/barang/style.css') }}">
@endpush