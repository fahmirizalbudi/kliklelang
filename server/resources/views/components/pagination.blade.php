<nav role="navigation" aria-label="Pagination Navigation" class="pagination">
  <button class="previous-page" {{ $paginator->onFirstPage() ? 'disabled' : '' }}
    onclick="window.location.href = '{{ $paginator->previousPageUrl() }}'">
    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path fill-rule="evenodd" clip-rule="evenodd" fill="currentColor"
        d="M2.58203 9.99868C2.58174 10.1909 2.6549 10.3833 2.80152 10.53L7.79818 15.5301C8.09097 15.8231 8.56584 15.8233 8.85883 15.5305C9.15183 15.2377 9.152 14.7629 8.85921 14.4699L5.13911 10.7472L16.6665 10.7472C17.0807 10.7472 17.4165 10.4114 17.4165 9.99715C17.4165 9.58294 17.0807 9.24715 16.6665 9.24715L5.14456 9.24715L8.85919 5.53016C9.15199 5.23717 9.15184 4.7623 8.85885 4.4695C8.56587 4.1767 8.09099 4.17685 7.79819 4.46984L2.84069 9.43049C2.68224 9.568 2.58203 9.77087 2.58203 9.99715C2.58203 9.99766 2.58203 9.99817 2.58203 9.99868Z">
      </path>
    </svg>
  </button>

  <ul class="pagination-elements">
    @foreach ($elements as $element)
      {{-- @if (is_string($element))
        <li class="px-3 py-1 text-gray-500">{{ $element }}</li>
      @endif --}}

      @if (is_array($element))
        @foreach ($element as $page => $url)
          <a href="{{ $page === $paginator->currentPage() ? '#' : $url }}"
            class="pagination-element {{ $page === $paginator->currentPage() ? 'active' : '' }}">
            <span>{{ $page }}</span>
          </a>
        @endforeach
      @endif
    @endforeach
  </ul>

  <button class="next-page" {{ !$paginator->hasMorePages() ? 'disabled' : '' }}
    onclick="window.location.href = '{{ $paginator->nextPageUrl() }}'">
    <svg class="fill-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path fill-rule="evenodd" clip-rule="evenodd" fill="currentColor"
        d="M17.4165 9.9986C17.4168 10.1909 17.3437 10.3832 17.197 10.53L12.2004 15.5301C11.9076 15.8231 11.4327 15.8233 11.1397 15.5305C10.8467 15.2377 10.8465 14.7629 11.1393 14.4699L14.8594 10.7472L3.33203 10.7472C2.91782 10.7472 2.58203 10.4114 2.58203 9.99715C2.58203 9.58294 2.91782 9.24715 3.33203 9.24715L14.854 9.24715L11.1393 5.53016C10.8465 5.23717 10.8467 4.7623 11.1397 4.4695C11.4327 4.1767 11.9075 4.17685 12.2003 4.46984L17.1578 9.43049C17.3163 9.568 17.4165 9.77087 17.4165 9.99715C17.4165 9.99763 17.4165 9.99812 17.4165 9.9986Z">
      </path>
    </svg>
  </button>
</nav>