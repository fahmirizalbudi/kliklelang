@props(['title', 'description', 'withAdd' => '', 'withAddText' => '', 'rowHeaders', 'v2' => false, 'filterItems' => []])

<div class="data-table">
  <div class="data-table-top">
    <div class="data-table-header">
      <h3 class="data-table-header-text">{{ $title }}</h3>
      <p class="data-table-header-description">{{ $description }}</p>
    </div>
    <div class="data-table-action">
      <div class="data-table-toggle-filter">
        @if (count($filterItems) > 0)
          @foreach ($filterItems as $item)
            <button onclick="window.location.href='{{ request()->fullUrlWithQuery(['status' => $item['value']]) }}'"
              class="data-table-toggle-filter-button {{ request()->input('status') == $item['value'] ? 'active' : '' }}">
              {{ $item['label'] }}
            </button>
          @endforeach
        @endif
      </div>
      <div class="data-table-filter-table-search">
        <div class="data-table-filter-table-search-container">
          <form>
            <x-text-field icon="search" placeholder="Search ..." name="search" :defaultValue="request()->input('search') ?? null"></x-text-field>
          </form>
        </div>
      </div>
      <button class="data-table-export-button">
        Export
        <x-icon name="export"></x-icon>
      </button>
      @if ($withAdd)
        <a href="{{ $withAdd }}" class="data-table-add-button">
          <x-icon name="add"></x-icon>
          {{ $withAddText }}
        </a>
      @endif
    </div>
  </div>
  @if (!$v2)
    <div class="data-table-filter-table">
      <div class="data-table-filter-table-container">
        <div class="data-table-filter-table-search">
          <div class="data-table-filter-table-search-container">
            <form>
              <x-text-field icon="search" placeholder="Search ..." name="search" :defaultValue="request()->input('search') ?? null"></x-text-field>
            </form>
          </div>
        </div>
        <div class="data-table-filter-table-select">
          <button class="data-table-filter-button">
            Filter
            <x-icon name="filter"></x-icon>
          </button>
        </div>
      </div>
    </div>
  @endif
  <div class="data-table-content-container">
    <table class="data-table-content">
      <thead class="data-table-thead">
        <tr class="data-table-row">
          <th class="data-table-row-header">#</th>
          @foreach ($rowHeaders as $rowHeader)
            <th class="data-table-row-header">{{ $rowHeader }}</th>
          @endforeach
        </tr>
      </thead>
      <tbody class="data-table-tbody">
        {{ $slot }}
      </tbody>
    </table>
  </div>
  <div class="data-table-footer">
    {{ $footer }}
  </div>
</div>

@push('scripts')
  <script src="{{ asset('js/event/search.js') }}"></script>
@endpush