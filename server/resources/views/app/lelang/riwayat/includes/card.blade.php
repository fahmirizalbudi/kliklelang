<li class="barang-list-container">
  <article>
    <a href="{{ route('app.lelang.bid', $lelang) }}" class="barang-list-inner">
      <div class="barang-list-image">
        <img src="{{ asset('storage/foto_barang/' . $lelang->barang->foto_barang) }}"
          alt="{{ asset('storage/foto_barang/' . $lelang->barang->foto_barang) }}">
      </div>
      <div class="barang-list-content">
        <p class="barang-name">{{ $lelang->barang->nama_barang }}</p>
        <div class="barang-status">
          <p class="barang-status-start-bid">
            Harga Awal
          </p>
          <p class="barang-status-current-bid">
            Harga Akhir ↗
          </p>
        </div>
        <div class="barang-bid">
          <p class="barang-start-bid">
            Rp
            {{ number_format($lelang->barang->harga_awal, 0, '.', '.') }}
          </p>
          <p class="barang-current-bid">
            Rp
            {{ $lelang->historyLelang->count() > 0 ? number_format($lelang->historyLelang->max('penawaran_harga'), 0, '.', '.') : '-' }}
          </p>
        </div>
      </div>
    </a>
  </article>
</li>