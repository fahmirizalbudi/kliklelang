<header class="app-header">
  <nav class="app-header-nav">
    <div class="navbar-brand">
      <a href="#" class="brand-link">
        <img src="{{ asset('brand.svg') }}" alt="KlikLelang" width="32" class="sidebar-logo">
        <span class="sidebar-brand-text">KlikLelang</span>
      </a>
    </div>
    @if (!request()->is('/'))
      <div class="search-bar">
        <form>
          <div class="search-bar-container">
            <span class="search-bar-icon">
              <svg class="fill-gray-500 dark:fill-gray-400" width="20" height="20" viewBox="0 0 20 20" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd"
                  d="M3.04175 9.37363C3.04175 5.87693 5.87711 3.04199 9.37508 3.04199C12.8731 3.04199 15.7084 5.87693 15.7084 9.37363C15.7084 12.8703 12.8731 15.7053 9.37508 15.7053C5.87711 15.7053 3.04175 12.8703 3.04175 9.37363ZM9.37508 1.54199C5.04902 1.54199 1.54175 5.04817 1.54175 9.37363C1.54175 13.6991 5.04902 17.2053 9.37508 17.2053C11.2674 17.2053 13.003 16.5344 14.357 15.4176L17.177 18.238C17.4699 18.5309 17.9448 18.5309 18.2377 18.238C18.5306 17.9451 18.5306 17.4703 18.2377 17.1774L15.418 14.3573C16.5365 13.0033 17.2084 11.2669 17.2084 9.37363C17.2084 5.04817 13.7011 1.54199 9.37508 1.54199Z"
                  fill="#667085"></path>
              </svg>
            </span>
            <input type="text" class="search-bar-input" placeholder="Cari barang atau lelang …" id="search-lelang">
          </div>
        </form>
      </div>
    @endif
    @if (!auth()->guard('masyarakat')->check())
      <div class="navbar-ctas">
        <a href="{{ route('login.view.masyarakat') }}" class="cta log-in-button">
          Log In
        </a>
        <a href="{{ route('login.view.masyarakat') }}" class="cta create-an-account">
          Create an Account
        </a>
      </div>
    @else
      <div class="user-profile">
        <a href="#" class="user-profile-wrapper">
          <span class="user-profile-avatar">
            <img
              src="{{ asset('assets/images/avatar.png') }}"
              width="42" height="42" alt="Profile Avatar">
          </span>
          @if (auth()->guard('petugas')->check())
            <span class="user-profile-name">{{ auth()->guard('petugas')->user()->nama_petugas }}</span>
          @else
            <span class="user-profile-name">{{ auth()->guard('masyarakat')->user()->nama_lengkap }}</span>
          @endif
          <svg class="profile-dropdown-arrow" width="18" height="20" viewBox="0 0 18 20" fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <path d="M4.3125 8.65625L9 13.3437L13.6875 8.65625" stroke="#667085" stroke-width="1.5" stroke-linecap="round"
              stroke-linejoin="round"></path>
          </svg>
        </a>
        <x-profile-dropdown></x-profile-dropdown>
      </div>
    @endif
  </nav>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const searchInput = document.getElementById('search-lelang');
      const daftarLelang = document.querySelectorAll('.barang-list-container');

      searchInput.addEventListener('input', e => {
        const searchValue = e.target.value.toLowerCase();

        daftarLelang.forEach(item => {
          const namaBarang = item.dataset.barang.toLowerCase();

          item.style.display = namaBarang.includes(searchValue)
            ? 'block'
            : 'none';
        });
      });
    });
  </script>
</header>