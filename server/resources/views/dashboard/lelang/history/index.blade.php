@extends('layouts.petugas')
@section('title', 'KlikLelang - Histori Lelang')

@section('content')
  <div class="lelang-histori">
    <x-breadcrumb groupPage="Pelelangan" currentPage="Histori Lelang"></x-breadcrumb>
    <section>
      <x-data-table title="Histori Lelang"
        description="Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae, neque!" :rowHeaders="['Lelang ID', 'Barang', 'Masyarakat', 'Harga Penawaran', '']" v2>
        <x-slot name="footer"></x-slot>
        @foreach ($histories as $history)
          <x-row>
            <x-cell>
              <p class="default-cell-text" style="color: #667085">{{ $histories->firstItem() + $loop->index }}</p>
            </x-cell>
            <x-cell>
              <p class="default-cell-text" style="font-weight: 500">#{{ $history->lelang->id_lelang }}</p>
            </x-cell>
            <x-cell>
              <div class="barang-cell">
                <div class="barang-preview">
                  <img class="barang-preview-image"
                    src="{{ asset('storage/foto_barang/' . $history->lelang->barang->foto_barang) }}"
                    alt="{{ $history->lelang->barang->nama_barang }}">
                </div>
                <span class="barang-text">{{ $history->lelang->barang->nama_barang }}</span>
              </div>
            </x-cell>
            <x-cell>
              <p class="default-cell-text">{{ $history->lelang->masyarakat->nama_lengkap }}</p>
            </x-cell>
            <x-cell>
              <p class="default-cell-text">Rp {{ number_format($history->penawaran_harga, 0, '.', '.') }}</p>
            </x-cell>
          </x-row>
        @endforeach
        <x-slot name="footer">
          {{ $histories->links('components.pagination') }}
        </x-slot>
      </x-data-table>
    </section>
  </div>
@endsection

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/pages/dashboard/lelang/history/style.css') }}">
@endpush