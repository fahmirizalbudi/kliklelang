@extends('layouts.petugas')
@section('title', 'KlikLelang - Barang')

@section('content')
  <div class="pemenang">
    <x-breadcrumb groupPage="Master Data" currentPage="Pemenang Lelang"></x-breadcrumb>
    <section>
      <x-data-table title="Daftar Pemenang Lelang"
        description="Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae, neque!" :rowHeaders="['Barang', 'Pemenang', 'Telepon', 'Harga Akhir', '']" export="{{ route('laporan.pemenang.export') }}">
        @foreach ($daftarPemenang as $pemenang)
          <x-row>
            <x-cell>
              <p class="default-cell-text" style="color: #667085">{{ $daftarPemenang->firstItem() + $loop->index }}</p>
            </x-cell>
            <x-cell>
              <div class="barang-cell">
                <div class="barang-preview">
                  <img class="barang-preview-image"
                    src="{{ asset('storage/foto_barang/' . $pemenang->barang->foto_barang) }}"
                    alt="{{ $pemenang->barang->nama_barang }}">
                </div>
                <span class="barang-text">{{ $pemenang->barang->nama_barang }}</span>
              </div>
            </x-cell>
            <x-cell>
              <p class="default-cell-text">{{ $pemenang->masyarakat->nama_lengkap }}</p>
            </x-cell>
            <x-cell>
              <p class="default-cell-text">{{ $pemenang->masyarakat->telp }}</p>
            </x-cell>
            <x-cell>
              <p class="default-cell-text">Rp {{ number_format($pemenang->harga_akhir, 0, '.', '.') }}</p>
            </x-cell>
          </x-row>
        @endforeach
        <x-slot name="footer">
          {{ $daftarPemenang->links('components.pagination') }}
        </x-slot>
      </x-data-table>
    </section>
  </div>
@endsection

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/pages/dashboard/laporan/pemenang.css') }}">
@endpush