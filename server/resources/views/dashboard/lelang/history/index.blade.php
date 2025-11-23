@extends('layouts.petugas')
@section('title', 'KlikLelang - Histori Lelang')

@section('content')
  <div class="lelang-histori">
    <x-breadcrumb groupPage="Pelelangan" currentPage="Histori Lelang"></x-breadcrumb>
    <section>
      <x-data-table title="Histori Lelang"
        description="Berikut adalah data history lelang yang telah ditambahkan ke sistem." :rowHeaders="['Lelang ID', 'Tanggal Lelang', 'Barang', 'Pemenang', 'Harga Akhir']" useDate withoutOptional>
        <x-slot name="footer"></x-slot>
        @foreach ($histories as $history)
          <x-row>
            <x-cell>
              <p class="default-cell-text" style="color: #667085">{{ $histories->firstItem() + $loop->index }}</p>
            </x-cell>
            <x-cell>
              <p onclick="window.location.href = '{{ route('lelang.detail', $history) }}'"
                class="default-cell-text idLelang" style="font-weight: 500">#{{ $history->id_lelang }}</p>
            </x-cell>
            <x-cell>
              <p class="default-cell-text">{{ $history->tgl_lelang }}</p>
            </x-cell>
            <x-cell>
              <div class="barang-cell">
                <div class="barang-preview">
                  <img class="barang-preview-image"
                    src="{{ asset('storage/foto_barang/' . $history->barang->foto_barang) }}"
                    alt="{{ $history->barang->nama_barang }}">
                </div>
                <span class="barang-text">{{ $history->barang->nama_barang }}</span>
              </div>
            </x-cell>
            <x-cell>
              <p class="default-cell-text">{{ $history->masyarakat->nama_lengkap ?? '-' }}</p>
            </x-cell>
            <x-cell>
              <p class="default-cell-text">Rp {{ number_format($history->harga_akhir, 0, '.', '.') }}</p>
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