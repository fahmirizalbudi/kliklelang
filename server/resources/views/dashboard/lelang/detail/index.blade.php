@extends('layouts.petugas')
@section('title', 'KlikLelang - Lelang')

@section('content')
  <div class="lelang-detail">
    <x-breadcrumb groupPage="Lelang" currentPage="Detail Lelang"></x-breadcrumb>
    <section>
      <div class="page-divider">
        <div class="card-detail">
          <div class="card-detail-left">
            <div class="lelang-detail-field">
              <span class="lelang-id">Lelang ID : #{{ $lelang->id_lelang }}</span>
              <span class="badge {{ $lelang->status }}">Lelang {{ $lelang->status }}</span>
            </div>
            <p class="lelang-date">
              Senin, 25 Agustus 2025
            </p>
          </div>
          <div class="card-detail-right">
            <button class="back-button" onclick="window.location.href = '{{ route('lelang.index') }}'">
              Kembali
            </button>
          </div>
        </div>

        <div class="grid-lelang-detail">
          <div class="grid-lelang-detail-left">
            <x-data-table title="Barang Lelang"
              description="Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae, neque!"
              :rowHeaders="['Barang', 'Tanggal', 'Harga Awal', 'Deskripsi', '']" v2 withoutFooter withoutOptional>
              <x-row>
                <x-cell>
                  <p class="default-cell-text" style="color: #667085">&times;</p>
                </x-cell>
                <x-cell>
                  <div class="barang-cell">
                    <div class="barang-preview">
                      <img class="barang-preview-image"
                        src="{{ asset('storage/foto_barang/' . $lelang->barang->foto_barang) }}"
                        alt="{{ $lelang->barang->nama_barang }}">
                    </div>
                    <span class="barang-text">{{ $lelang->barang->nama_barang }}</span>
                  </div>
                </x-cell>
                <x-cell>
                  <p class="default-cell-text">{{ $lelang->barang->tgl }}</p>
                </x-cell>
                <x-cell>
                  <p class="default-cell-text">Rp {{ number_format($lelang->barang->harga_awal, 0, '.', '.') }}</p>
                </x-cell>
                <x-cell className="barang-description">
                  <p class="default-cell-text"
                    style="width: 100%; overflow: hidden; white-space: nowrap; text-overflow: ellipsis">
                    {{ $lelang->barang->deskripsi_barang }}
                  </p>
                </x-cell>
              </x-row>
            </x-data-table>
            <x-data-table title="Rekapan Tawaran Lelang"
              description="Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae, neque!"
              :rowHeaders="['Masyarakat', 'Penawaran Harga', '']" withoutFooter>
              @foreach ($lelang->historyLelang->sortByDesc('penawaran_harga') as $history)
                <x-row>
                  <x-cell>
                    <p class="default-cell-text" style="color: #667085; font-weight: {{ $loop->index === 0 ? '600' : '400' }}">{{ $loop->iteration }}</p>
                  </x-cell>
                  <x-cell>
                    <p class="default-cell-text" style="font-weight: {{ $loop->index === 0 ? '600' : '400' }}">{{ $history->masyarakat->nama_lengkap }}</p>
                  </x-cell>
                  <x-cell>
                    <p class="default-cell-text" style="font-weight: {{ $loop->index === 0 ? '600' : '400' }}">Rp {{ number_format($history->penawaran_harga, 0, '.', '.') }}</p>
                  </x-cell>
                </x-row>
              @endforeach
            </x-data-table>
          </div>
          <div class="grid-lelang-detail-right">
            <div class="winner-detail">
              <h2 class="winner-detail-text">Pemenang Lelang</h2>
              <ul class="winner-detail-list">
                <li class="winner-detail-item">
                  <span class="winner-detail-key">Nama Lengkap</span>
                  <span class="winner-detail-value">{{ $lelang->masyarakat->nama_lengkap ?? '-' }}</span>
                </li>
                <li class="winner-detail-item">
                  <span class="winner-detail-key">Username</span>
                  <span class="winner-detail-value">{{ $lelang->masyarakat ? '@' . $lelang->masyarakat->username : '-' }}</span>
                </li>
                <li class="winner-detail-item">
                  <span class="winner-detail-key">Telepon</span>
                  <span class="winner-detail-value">{{ $lelang->masyarakat->telp ?? '-' }}</span>
                </li>
                <li class="winner-detail-item">
                  <span class="winner-detail-key">Alamat</span>
                  <span class="winner-detail-value">{{ $lelang->masyarakat->alamat ?? '-' }}</span>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/pages/dashboard/lelang/detail/style.css') }}">
@endpush