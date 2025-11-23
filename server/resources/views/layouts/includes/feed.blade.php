<div class="feed-wrapper">
  <div class="feed-content">
    <ul class="tab-list">
      <div class="tab-list-inner">
        <div class="tab-list-item">
          <a href="{{ route('app.index') }}" class="tab-list-item-anchor">
            <li class="tab-list-content">
              <button
                class="tab-list-button {{ request()->is('/') ? 'active' : '' }}">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M12.45 4.90342C12.1833 4.70342 11.8167 4.70342 11.55 4.90342L5.05 9.77842C4.86115 9.92006 4.75 10.1423 4.75 10.3784V18.4998C4.75 18.9141 5.08579 19.2498 5.5 19.2498H9V16.9998C9 15.343 10.3431 13.9998 12 13.9998C13.6569 13.9998 15 15.343 15 16.9998V19.2498H18.5C18.9142 19.2498 19.25 18.9141 19.25 18.4998V10.3784C19.25 10.1423 19.1389 9.92006 18.95 9.77842L12.45 4.90342ZM10.65 3.70342C11.45 3.10342 12.55 3.10342 13.35 3.70342L19.85 8.57842C20.4166 9.00334 20.75 9.67021 20.75 10.3784V18.4998C20.75 19.7425 19.7426 20.7498 18.5 20.7498H14.25C13.8358 20.7498 13.5 20.4141 13.5 19.9998V16.9998C13.5 16.1714 12.8284 15.4998 12 15.4998C11.1716 15.4998 10.5 16.1714 10.5 16.9998V19.9998C10.5 20.4141 10.1642 20.7498 9.75 20.7498H5.5C4.25736 20.7498 3.25 19.7425 3.25 18.4998V10.3784C3.25 9.67021 3.58344 9.00334 4.15 8.57842L10.65 3.70342Z"
                    stroke="currentColor" fill="currentColor" stroke-width="0.75" />
                </svg>
                <span class="tab-list-text">Beranda</span>
              </button>
            </li>
          </a>
        </div>
        <div class="tab-list-item">
          <a href="#" class="tab-list-item-anchor">
            <li class="tab-list-content">
              <button class="tab-list-button">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path
                    d="M9.53516 8.38888C9.53516 7.02801 10.6384 5.9248 11.9992 5.9248C13.3601 5.9248 14.4633 7.02801 14.4633 8.38888C14.4633 9.14771 14.1217 9.82569 13.5797 10.2795C13.061 10.7138 12.4004 11.2694 11.8773 11.9191C11.3484 12.576 10.8742 13.4322 10.8742 14.478V15.3003C10.8742 15.9216 11.3779 16.4253 11.9992 16.4253C12.6206 16.4253 13.1242 15.9216 13.1242 15.3003V14.478C13.1242 14.143 13.2721 13.7744 13.6298 13.3302C13.9933 12.8787 14.4841 12.4567 15.0241 12.0046C16.0548 11.1417 16.7133 9.84165 16.7133 8.38888C16.7133 5.78537 14.6027 3.6748 11.9992 3.6748C9.39572 3.6748 7.28516 5.78537 7.28516 8.38888C7.28516 9.0102 7.78884 9.51388 8.41016 9.51388C9.03148 9.51388 9.53516 9.0102 9.53516 8.38888Z"
                    fill="currentColor" stroke="currentColor" stroke-width="0.5" />
                  <path
                    d="M11.998 17.7758C11.2939 17.7758 10.723 18.3466 10.723 19.0508C10.723 19.7549 11.2939 20.3258 11.998 20.3258C12.7022 20.3258 13.274 19.7549 13.274 19.0508C13.274 18.3466 12.7022 17.7758 11.998 17.7758Z"
                    fill="currentColor" stroke="currentColor" stroke-width="0.5" />
                </svg>
                <span class="tab-list-text">Segera Hadir</span>
              </button>
            </li>
          </a>
        </div>
        <div class="tab-list-item">
          <a href="{{ route('app.lelang') }}" class="tab-list-item-anchor">
            <li class="tab-list-content">
              <button class="tab-list-button {{ request()->is('lelang*') ? 'active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"
                  role="img" class="FeedAndCategoryNavigation_svg-icon-active__vCoh1 u-color-brand u-m-b-xxs u-icon-m">
                  <path fill="currentColor" d="M1.5 22h12v2h-12zm0-8.272 1.414-1.414 6.364 6.364-1.414 1.414z"></path>
                  <path fill="currentColor" fill-rule="evenodd"
                    d="M12.106 5.95 6.45 11.607l3.535 3.535 5.657-5.657zm-8.485 5.657 6.364 6.364 8.485-8.486-6.364-6.364z"
                    clip-rule="evenodd"></path>
                  <path fill="currentColor"
                    d="M12.815 2.414 14.229 1l6.364 6.364-1.415 1.414zm.353 12.375 2.121-2.122 8.193 8.193-2.121 2.122z">
                  </path>
                </svg>
                <span class="tab-list-text">Lelang</span>
              </button>
            </li>
          </a>
        </div>
        <div class="tab-list-item">
          <a href="{{ route('app.history') }}" class="tab-list-item-anchor">
            <li class="tab-list-content">
              <button class="tab-list-button {{ request()->is('history*') ? 'active' : '' }}">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path
                    d="M9.74902 2.75C9.74902 2.33579 10.0848 2 10.499 2H13.499C13.9132 2 14.249 2.33579 14.249 2.75C14.249 3.16421 13.9132 3.5 13.499 3.5H10.499C10.0848 3.5 9.74902 3.16421 9.74902 2.75Z"
                    fill="currentColor" stroke="currentColor" stroke-width="0.5" />
                  <path
                    d="M11.2485 13.2507C11.2485 13.6649 11.5843 14.0007 11.9985 14.0007C12.4128 14.0007 12.7485 13.6649 12.7485 13.2507V8.49454C12.7485 8.08033 12.4128 7.74454 11.9985 7.74454C11.5843 7.74454 11.2485 8.08033 11.2485 8.49454V13.2507Z"
                    fill="currentColor" stroke="currentColor" stroke-width="0.5" />
                  <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M11.999 4.50192C7.16707 4.50192 3.25 8.41899 3.25 13.2509C3.25 18.0829 7.16707 22 11.999 22C16.831 22 20.748 18.0829 20.748 13.2509C20.748 11.1048 19.9753 9.13916 18.6929 7.61704L20.0316 6.27838C20.3244 5.98548 20.3244 5.51061 20.0316 5.21772C19.7387 4.92482 19.2638 4.92482 18.9709 5.21772L17.6322 6.55644C16.1102 5.2744 14.1448 4.50192 11.999 4.50192ZM4.75 13.2509C4.75 9.24742 7.99549 6.00192 11.999 6.00192C16.0025 6.00192 19.248 9.24742 19.248 13.2509C19.248 17.2545 16.0025 20.5 11.999 20.5C7.99549 20.5 4.75 17.2545 4.75 13.2509Z"
                    fill="currentColor" stroke="currentColor" stroke-width="0.5" />
                </svg>
                <span class="tab-list-text">Riwayat</span>
              </button>
            </li>
          </a>
        </div>
      </div>
    </ul>
  </div>
</div>