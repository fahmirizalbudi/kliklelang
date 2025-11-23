@extends('layouts.petugas')
@section('title', 'KlikLelang - Laporan Pemenang Lelang')

@section('content')
  <div class="pemenang">
    <x-breadcrumb groupPage="Master Data" currentPage="Laporan Pemenang Lelang"></x-breadcrumb>
    <section>
      <x-data-table title="Daftar Pemenang Lelang"
        description="Berikut adalah data pemenang lelang yang telah ditambahkan ke sistem." :rowHeaders="['Tanggal Lelang', 'Barang', 'Petugas', 'Pemenang', 'Telepon Pemenang', 'Harga Akhir']"
        export="{{ route('laporan.pemenang.export', request()->all()) }}" useDate>
        @if (Auth::guard('petugas')->user()->level->level === 'administrator')
          <x-slot name="selectPetugas">
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
          </x-slot>
        @endif
        @foreach ($daftarPemenang as $pemenang)
          <x-row>
            <x-cell>
              <p class="default-cell-text" style="color: #667085">{{ $daftarPemenang->firstItem() + $loop->index }}</p>
            </x-cell>
            <x-cell>
              <p class="default-cell-text">{{ $pemenang->tgl_lelang }}</p>
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
              <p class="default-cell-text">{{ $pemenang->petugas->nama_petugas }}</p>
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