<li class="barang-list-container" data-barang="{{ $lelang->barang->nama_barang }}">
  <article class="lelang-card">

    @if ($lelang->status === 'ditutup' && $userBid)
      @if ($userBid == $highestBid)
        <div class="ribbon ribbon-menang">Menang</div>
      @else
        <div class="ribbon ribbon-kalah">Kalah</div>
      @endif
    @endif

    <a href="{{ route('app.lelang.bid', $lelang) }}" class="barang-list-inner">
      <div class="barang-list-image">
        <img src="{{ asset('storage/foto_barang/' . $lelang->barang->foto_barang) }}"
          alt="{{ $lelang->barang->nama_barang }}" loading="lazy">
      </div>
      <div class="barang-list-content">
        <p class="barang-name">{{ $lelang->barang->nama_barang }}</p>

        @php
          $topBid = $lelang->historyLelang->sortByDesc('penawaran_harga')->first();
        @endphp

        <div class="barang-bid-details">
          <div class="barang-bid-group">
            <p class="barang-bid-label">Harga Awal</p>
            <p class="barang-bid-value start-price">
              Rp {{ number_format($lelang->barang->harga_awal, 0, '.', '.') }}
            </p>
          </div>
          <div class="barang-bid-group current">
            <p class="barang-bid-label">
              {{ $lelang->status === 'ditutup' ? 'Harga Akhir' : 'Top Bid' }}
            </p>
            <p class="barang-bid-value current-price{{ !$topBid ? ' no-bid' : '' }}">
              @if($topBid)
                Rp {{ number_format($topBid->penawaran_harga, 0, '.', '.') }}
              @else
                -
              @endif
            </p>
          </div>
        </div>

        <div class="barang-bidder-info">
          @if($topBid)
            <span class="bidder-label">
              {{ $lelang->status === 'ditutup' ? 'Pemenang:' : 'Penawar Tertinggi:' }}
            </span>
            <span class="bidder-name">
              @if($topBid->masyarakat)
                {{ $topBid->masyarakat->nama_lengkap }}
              @else
                (Data tidak ada)
              @endif
            </span>
          @else
            <span class="bidder-label no-bid-message">Tidak ada penawar</span>
          @endif
        </div>
      </div>
    </a>
  </article>
</li>