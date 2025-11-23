@extends('layouts.petugas')
@section('title', 'KlikLelang - Lelang')

@section('content')
  <div class="lelang">
    <x-breadcrumb groupPage="Pelelangan" currentPage="Lelang"></x-breadcrumb>
    <section>
      <x-overview-card title="Ringkasan" withAdd="{{ route('lelang.activation') }}" withAddText="Aktivasi Lelang"
        :items="$items"></x-overview-card>
      <x-data-table title="Daftar Lelang"
        description="Berikut adalah data lelang yang telah ditambahkan ke sistem." :rowHeaders="['Barang', 'Tanggal Lelang', 'Harga Akhir', 'Status', 'Petugas', 'Pemenang', '']" :filterItems="$filterItems" v2
        withoutOptional>
        <x-slot name="footer"></x-slot>
        @foreach ($daftarLelang as $lelang)
          @php
            $statusnya = null;
            if ($lelang->status === 'dibuka') {
              $statusnya = 'dibuka';
            } elseif ($lelang->status === 'ditutup' && $lelang->id_user === null) {
              $statusnya = 'ditutup';
            } elseif ($lelang->status === 'ditutup' && $lelang->id_user) {
              $statusnya = 'selesai';
            }
          @endphp
          <x-row>
            <x-cell>
              <p class="default-cell-text" style="color: #667085">{{ $daftarLelang->firstItem() + $loop->index }}</p>
            </x-cell>
            <x-cell>
              <div class="barang-cell">
                <div class="barang-preview">
                  <img class="barang-preview-image" src="{{ asset('storage/foto_barang/' . $lelang->barang->foto_barang) }}"
                    alt="{{ $lelang->barang->nama_barang }}">
                </div>
                <span class="barang-text">{{ $lelang->barang->nama_barang }}</span>
              </div>
            </x-cell>
            <x-cell>
              <p class="default-cell-text">{{ $lelang->tgl_lelang }}</p>
            </x-cell>
            <x-cell>
              <p class="default-cell-text">Rp
                {{ $lelang->harga_akhir === null ? '-' : number_format($lelang->harga_akhir, 0, '.', '.') }}
              </p>
            </x-cell>
            <x-cell>
              <span
                class="badge {{ $statusnya }}">{{ $statusnya }}</span>
            </x-cell>
            <x-cell>
              <p class="default-cell-text">{{ $lelang->petugas->nama_petugas }}</p>
            </x-cell>
            <x-cell>
              <p class="default-cell-text">{{ $lelang->masyarakat === null ? '-' : $lelang->masyarakat->nama_lengkap }}</p>
            </x-cell>
            <x-cell>
              <div class="lelang-actions">
                <x-custom-action icon="detail_lelang" color="#475467" actionTo="{{ route('lelang.detail', $lelang) }}"
                  method="GET">Detail
                  Lelang</x-custom-action>
                @if ($lelang->status === 'dibuka')
                  <x-custom-action icon="tutup_lelang" color="#d92d20" actionTo="{{ route('lelang.close', $lelang) }}"
                    method="PATCH">Tutup
                    Lelang</x-custom-action>
                @else
                  <x-custom-action icon="buka_lelang" color="#027a48" actionTo="{{ route('lelang.open', $lelang) }}"
                    method="PATCH">Buka
                    Lelang</x-custom-action>
                @endif
                <x-delete-action actionTo="{{ route('lelang.destroy', $lelang) }}"></x-delete-action>
              </div>
            </x-cell>
          </x-row>
        @endforeach
        <x-slot name="footer">
          {{ $daftarLelang->links('components.pagination') }}
        </x-slot>
      </x-data-table>
    </section>
  </div>
@endsection

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/pages/dashboard/lelang/style.css') }}">
@endpush