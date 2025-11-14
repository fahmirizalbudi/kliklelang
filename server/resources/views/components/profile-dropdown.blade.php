<div class="profile-dropdown">
  <div class="profile-header">
    <span>{{ auth()->guard('petugas')->user()->nama_petugas }}</span><br>
    <span>{{ auth()->guard('petugas')->user()->username }}</span>
  </div>

  <div class="profile-list">
    <a href="#" class="profile-list-item">
      <x-icon name="profile"></x-icon>
      Edit Profile
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