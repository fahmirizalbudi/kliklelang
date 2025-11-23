<header class="appbar">
  <div class="appbar-container">
    <div class="appbar-left-section">
      <button class="hamburger">
        <svg class="hidden fill-current xl:block" width="16" height="12" viewBox="0 0 16 12" fill="none"
          xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" clip-rule="evenodd"
            d="M0.583252 1C0.583252 0.585788 0.919038 0.25 1.33325 0.25H14.6666C15.0808 0.25 15.4166 0.585786 15.4166 1C15.4166 1.41421 15.0808 1.75 14.6666 1.75L1.33325 1.75C0.919038 1.75 0.583252 1.41422 0.583252 1ZM0.583252 11C0.583252 10.5858 0.919038 10.25 1.33325 10.25L14.6666 10.25C15.0808 10.25 15.4166 10.5858 15.4166 11C15.4166 11.4142 15.0808 11.75 14.6666 11.75L1.33325 11.75C0.919038 11.75 0.583252 11.4142 0.583252 11ZM1.33325 5.25C0.919038 5.25 0.583252 5.58579 0.583252 6C0.583252 6.41421 0.919038 6.75 1.33325 6.75L7.99992 6.75C8.41413 6.75 8.74992 6.41421 8.74992 6C8.74992 5.58579 8.41413 5.25 7.99992 5.25L1.33325 5.25Z"
            fill="#667085"></path>
        </svg>
      </button>
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
            <input type="text" class="search-bar-input" placeholder="Search or type command ...">
          </div>
        </form>
      </div>
    </div>
    <div class="appbar-right-section">
      <div class="user-profile">
        <a href="#" class="user-profile-wrapper">
          <span class="user-profile-avatar">
            <img src="{{ asset('assets/images/avatar.png') }}" width="42" height="42" alt="Profile Avatar">
          </span>
          <span class="user-profile-name">{{ auth()->guard('petugas')->user()->nama_petugas }}</span>
          <svg class="profile-dropdown-arrow" width="18" height="20" viewBox="0 0 18 20" fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <path d="M4.3125 8.65625L9 13.3437L13.6875 8.65625" stroke="#667085" stroke-width="1.5" stroke-linecap="round"
              stroke-linejoin="round"></path>
          </svg>
        </a>
        <x-profile-dropdown></x-profile-dropdown>
      </div>
    </div>
  </div>
</header>