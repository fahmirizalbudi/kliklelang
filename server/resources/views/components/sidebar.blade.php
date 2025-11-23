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
        <x-sidebar-item text="Beranda" icon="beranda" linkTo="{{ route('home') }}" :active="request()->is('dashboard') || request()->is('auth/profile')" />
      </x-sidebar-group>

      <x-sidebar-group title="Master Data">
        @if (auth()->guard('petugas')->user()->level->level === 'administrator')
          <x-sidebar-item text="Petugas" icon="admin_petugas" linkTo="{{ route('petugas.index') }}"
            :active="request()->is('*/petugas*')" />
        @endif
        <x-sidebar-item text="Barang" icon="barang" linkTo="{{ route('barang.index') }}"
          :active="request()->is('*/barang*')" />
        @if (auth()->guard('petugas')->user()->level->level === 'administrator')
          <x-sidebar-item text="Masyarakat" icon="masyarakat" linkTo="{{ route('masyarakat.index') }}"
            :active="request()->is('*/masyarakat*')" />
        @endif
      </x-sidebar-group>

      @if (auth()->guard('petugas')->user()->level->level === 'petugas')
        <x-sidebar-group title="Pelelangan">
          <x-sidebar-item text="Lelang" icon="lelang" linkTo="{{ route('lelang.index') }}"
            :active="(request()->is('*/lelang*') && request()->path() !== 'dashboard/lelang/histori')" />
          <x-sidebar-item text="Histori Lelang" icon="histori_lelang" linkTo="{{ route('lelang.history') }}"
            :active="request()->path() === 'dashboard/lelang/histori'" />
        </x-sidebar-group>
      @endif

      <x-sidebar-group title="Rekap">
        <x-sidebar-item text="Lap. Aktivitas Lelang" icon="laporan" linkTo="{{ route('laporan.aktivitas') }}"
          :active="request()->path() === 'dashboard/laporan/aktivitas'" />
        <x-sidebar-item text="Lap. Pemenang Lelang" icon="laporan" linkTo="{{ route('laporan.pemenang') }}"
          :active="request()->path() === 'dashboard/laporan/pemenang'" />
      </x-sidebar-group>
    </nav>
  </div>
</aside>