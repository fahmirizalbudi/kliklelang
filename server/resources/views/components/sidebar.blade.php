<aside class="sidebar">
  <div class="sidebar-brand">
    <a href="#" class="brand-link">
      <img src="{{ asset('brand.svg') }}" alt="KlikLelang" width="32" class="sidebar-logo">
      <span class="sidebar-brand-text">KlikLelang</span>
    </a>
  </div>
  <div class="sidebar-content">
    <nav class="sidebar-menus">
      <x-sidebar-group title="Main">
        <x-sidebar-item text="Beranda" icon="beranda" active />
      </x-sidebar-group>

      <x-sidebar-group title="Master Data">
        <x-sidebar-item text="Admin & Petugas" icon="admin_petugas" />
        <x-sidebar-item text="Barang" icon="barang" />
        <x-sidebar-item text="Masyarakat" icon="masyarakat" />
      </x-sidebar-group>

      <x-sidebar-group title="Pelelangan">
        <x-sidebar-item text="Lelang" icon="lelang" />
        <x-sidebar-item text="Histori Lelang" icon="histori_lelang" />
      </x-sidebar-group>

      <x-sidebar-group title="Rekap">
        <x-sidebar-item text="Laporan" icon="laporan" />
      </x-sidebar-group>

      <x-sidebar-group title="Lainnya">
        <x-sidebar-item text="Tentang" icon="tentang" />
      </x-sidebar-group>
    </nav>
  </div>
</aside>