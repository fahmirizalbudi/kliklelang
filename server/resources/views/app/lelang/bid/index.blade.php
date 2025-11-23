@extends('layouts.app')
@section('title', 'KlikLelang - Lelang')

@section('content')
  <section id="detail-lelang">
    <div class="detail-lelang-container">
      <div class="detail-lelang-left-section">
        <header class="detail-lelang-header">
          <h1 class="detail-lelang-header-text">{{ $lelang->barang->nama_barang }}</h1>
        </header>
        <div class="barang-preview">
          <img class="barang-preview-image" src="{{ asset('storage/foto_barang/' . $lelang->barang->foto_barang) }}"
            alt="{{ $lelang->barang->nama_barang }}">
        </div>
        <hr class="divider">
        <div class="barang-description">
          <h4 class="barang-description-header">Deskripsi Barang</h4>
          <p class="barang-description-text">{{ $lelang->barang->deskripsi_barang }}</p>
        </div>
      </div>
      <div class="detail-lelang-right-section">
        <div class="detail-lelang-tanggal">
          <p class="detail-lelang-tanggal-text">
            {{ \Carbon\Carbon::parse($lelang->tgl_lelang)->locale('id')->translatedFormat('l, d F Y') }}
          </p>
          <span>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" aria-hidden="true">
              <path fill="currentColor" stroke="currentColor" stroke-width="0.2"
                d="M11.333 14.666v-2h-2v-1.333h2v-2h1.334v2h2v1.333h-2v2zm-8-1.333q-.55 0-.941-.392A1.28 1.28 0 0 1 2 12V4q0-.55.392-.942.391-.392.941-.392H4V1.333h1.333v1.333h4V1.333h1.334v1.333h.666q.55 0 .942.392t.392.942v4.066a4.5 4.5 0 0 0-1.334 0v-1.4h-8V12H8q0 .333.05.666.05.334.183.667zm0-8h8V4h-8z">
              </path>
            </svg>
          </span>
        </div>
        <div class="detail-lelang-bid-info">
          <p class="barang-lelang-status-current-bid">
            HARGA AWAL
          </p>
          <p class="barang-lelang-current-bid">
            Rp
            {{ number_format($lelang->barang->harga_awal, 0, '.', '.') }}
          </p>
          <p class="barang-lelang-status-current-bid">
            Penawaran Tertinggi ↗
          </p>
          <p class="barang-lelang-current-bid">
            Rp
            {{ $lelang->historyLelang->count() > 0 ? number_format($lelang->historyLelang->max('penawaran_harga'), 0, '.', '.') : '-' }}
          </p>
          <span class="badge {{ $lelang->status === 'dibuka' ? 'dibuka' : 'ditutup' }}">Lelang
            {{ $lelang->status }}</span>
        </div>

        @if ($lelang->status === 'dibuka')
          <form class="detail-lelang-bid-action" action="{{ route('app.lelang.bidding', $lelang) }}" method="POST">
            @csrf
            <div>
              <x-label-field forField="penawaran_harga">Penawaran Harga</x-label-field>
              <x-text-field type="number" name="penawaran_harga"
                placeholder="Masukkan penawaran (min. Rp {{ number_format($lelang->historyLelang->count() > 0 ? $lelang->historyLelang->max('penawaran_harga') : $lelang->barang->harga_awal, 0, '.', '.') }})"
                defaultValue="{{ old('penawaran_harga') }}"></x-text-field>
            </div>

            <button type="submit" class="bid-submit">Ajukan Penawaran</button>
          </form>
        @endif

        @if ($lelang->status === 'ditutup')
          @php
            $pemenang = $lelang->historyLelang->sortByDesc('penawaran_harga')->first();
          @endphp

          <div class="pemenang-lelang">
            <x-label-field forField="pemenang">Pemenang Lelang</x-label-field>
            <x-select-field name="pemenang" placeholder="No placeholder" defaultValue="{{ $pemenang->masyarakat->id_user }}"
              disabled>
              @foreach ($lelang->historyLelang->sortByDesc('penawaran_harga') as $item)
                <option value="{{ $item->masyarakat->id_user }}"
                  data-img="{{ asset('assets/images/avatar.png') }}"
                  data-html="@<span style='text-transform: none'>{{ $item->masyarakat->username }}</span> ~ &nbsp; <span>{{ $item->masyarakat->nama_lengkap }}</span>">
                </option>
              @endforeach
            </x-select-field>
          </div>
        @endif

        @if ($lelang->historyLelang->count() > 0)
          <hr class="bid-divider">

          <div class="bid-details">
            <div class="watching-box">
              <span>{{ $lelang->historyLelang->count() }} tawaran yang telah diajukan</span>
            </div>

            <ul class="bid-list">
              @foreach ($lelang->historyLelang->sortByDesc('penawaran_harga') as $history)
                <li class="bid-item">
                  <div class="bid-item-container">
                    <span class="bidder"><strong>{{ '@' . $history->masyarakat->username }}</strong></span>
                    <span class="time">{{ $history->created_at->diffForHumans() }}</span>
                    <span class="price">Rp {{ number_format($history->penawaran_harga, 0, '.', '.') }}</span>
                </li>
              @endforeach
            </ul>
          </div>
        @endif
      </div>
    </div>
  </section>
@endsection

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/pages/app/lelang/bid/style.css') }}">
@endpush