<div class="profile-dropdown">
  <div class="profile-header">
    @if (auth()->guard('petugas')->check())
      <span>{{ auth()->guard('petugas')->user()->nama_petugas }}</span><br>
      <span>{{ '@' . auth()->guard('petugas')->user()->username }}</span>
    @else
      <span>{{ auth()->guard('masyarakat')->user()->nama_lengkap }}</span><br>
      <span>{{ '@' . auth()->guard('masyarakat')->user()->username }}</span>
    @endif
  </div>

  <div class="profile-list">
    <a href="{{ route('profile') }}" class="profile-list-item">
      <x-icon name="profile"></x-icon>
      Profile Pengguna
    </a>
  </div>

  <form action="{{ route('logout') }}" method="POST">
    @csrf
    <button class="signout-btn">
      <x-icon name="logout"></x-icon>
      Log Out
    </button>
  </form>
</div>