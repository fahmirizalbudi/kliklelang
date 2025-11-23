@extends('layouts.petugas')
@section('title', 'KlikLelang - Laporan Aktivitas Lelang')

@section('content')
  <div class="aktivitas">
    <x-breadcrumb groupPage="Master Data" currentPage="Laporan Aktivitas Lelang"></x-breadcrumb>
    <section>
      <x-data-table title="Daftar Aktivitas Lelang"
        description="Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae, neque!" :rowHeaders="['Tanggal Lelang', 'Barang', 'Petugas', 'Pemenang', 'Telepon Pemenang', 'Harga Akhir', 'Status']"
        export="{!! route('laporan.aktivitas.export', request()->all()) !!}" useDate>
        <x-slot name="selectPetugas">
          @if (Auth::guard('petugas')->user()->level->level === 'administrator')
            <div class="selectPetugas">
              <x-select-field placeholder="Pilih petugas" name="petugas" defaultValue="{{ request()->input('petugas') }}">
                <option value="">Semua</option>
                @foreach ($daftarPetugas as $petugas)
                  <x-slot name="onChange">
                    const url = new URL(window.location.href);
                    url.searchParams.set("petugas", value);
                    window.location.href = url.toString();
                  </x-slot>
                  <option value="{{ $petugas->id_petugas }}">{{ $petugas->nama_petugas }}</option>
                @endforeach
              </x-select-field>
            </div>
          @endif
          <div class="selectPetugas">
            <x-select-field placeholder="Pilih status" name="status" defaultValue="{{ request()->input('status') }}">
              <x-slot name="onChange">
                const url = new URL(window.location.href);
                url.searchParams.set("status", value);
                window.location.href = url.toString();
              </x-slot>
              <option value="">Semua</option>
              <option value="ditutup">Ditutup</option>
              <option value="dibuka">Dibuka</option>
              <option value="selesai">Selesai</option>
            </x-select-field>
          </div>
        </x-slot>
        @foreach ($daftarLelang as $lelang)
          @php
            $statusnya = null;
            if ($lelang->status === 'dibuka') {
              $statusnya = 'dibuka';
            } elseif ($lelang->status === 'ditutup' && $lelang->id_user === null) {
              $statusnya = 'ditutup';
            } elseif ($lelang->status === 'ditutup' && $lelang->historyLelang->count() > 0 && $lelang->id_user) {
              $statusnya = 'selesai';
            }
          @endphp
          <x-row>
            <x-cell>
              <p class="default-cell-text" style="color: #667085">{{ $daftarLelang->firstItem() + $loop->index }}</p>
            </x-cell>
            <x-cell>
              <p class="default-cell-text">{{ $lelang->tgl_lelang }}</p>
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
              <p class="default-cell-text">{{ $lelang->petugas->nama_petugas }}</p>
            </x-cell>
            <x-cell>
              <p class="default-cell-text">{{ $lelang->masyarakat ? $lelang->masyarakat->nama_lengkap : '-' }}</p>
            </x-cell>
            <x-cell>
              <p class="default-cell-text">{{ $lelang->masyarakat ? $lelang->masyarakat->telp : '-' }}</p>
            </x-cell>
            <x-cell>
              <p class="default-cell-text">Rp
                {{ $lelang->harga_akhir ? number_format($lelang->harga_akhir, 0, '.', '.') : '-' }}
              </p>
            </x-cell>
            <x-cell>
              <span class="badge {{ $statusnya }}">{{ $statusnya }}</span>
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
  <link rel="stylesheet" href="{{ asset('css/pages/dashboard/laporan/aktivitas.css') }}">
@endpush