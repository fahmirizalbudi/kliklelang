<li class="barang-list-container" data-barang="{{ $lelang->barang->nama_barang }}">
  <article class="lelang-card">

    <div class="ribbon ribbon-segera">Segera Hadir</div>

    <div class="barang-list-inner is-coming-soon">
      <div class="barang-list-image">
        <img src="{{ asset('storage/foto_barang/' . $lelang->barang->foto_barang) }}"
          alt="{{ $lelang->barang->nama_barang }}" loading="lazy">
      </div>
      <div class="barang-list-content">
        <p class="barang-name">{{ $lelang->barang->nama_barang }}</p>

        <div class="barang-coming-soon-info">
          <p class="coming-soon-label">Akan dibuka pada:</p>
          <p class="coming-soon-date">
            {{ \Carbon\Carbon::parse($lelang->tgl_lelang)->translatedFormat('l, d F Y') }}
          </p>
        </div>

      </div>
    </div>
  </article>
</li>