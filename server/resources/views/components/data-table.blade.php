@props(['title', 'description', 'withAdd' => '', 'withAddText' => '', 'rowHeaders', 'v2' => false, 'filterItems' => [], 'withoutFooter' => false, 'withoutOptional' => false, 'export' => null, 'useDate' => false, 'selectPetugas' => null])

<div class="data-table">
  <div class="data-table-top">
    <div class="data-table-header">
      <h3 class="data-table-header-text">{{ $title }}</h3>
      <p class="data-table-header-description">{{ $description }}</p>
    </div>
    <div class="data-table-action">
      @if ($v2)
        @if (count($filterItems) > 0)
          <div class="data-table-toggle-filter">
            @foreach ($filterItems as $item)
              <button onclick="window.location.href='{{ request()->fullUrlWithQuery(['status' => $item['value']]) }}'"
                class="data-table-toggle-filter-button {{ request()->input('status') == $item['value'] ? 'active' : '' }}">
                {{ $item['label'] }}
              </button>
            @endforeach
          </div>
        @endif
        @if (!$withoutOptional)
          <div class="data-table-filter-table-search">
            <div class="data-table-filter-table-search-container">
              <form>
                <x-text-field icon="search" placeholder="Search ..." name="search" :defaultValue="request()->input('search') ?? null"></x-text-field>
              </form>
            </div>
          </div>
        @endif
      @endif
      {{ $selectPetugas }}
      @if (!$withoutOptional)
        <button class="data-table-export-button" onclick="window.location.href = '{{ $export }}'">
          Export
          <x-icon name="export"></x-icon>
        </button>
      @endif
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
        @if ($useDate)
          <div class="data-table-date-filter" style="display: flex; gap: 0.75rem; align-items: center;">
            <x-text-field type="date" name="mulai" placeholder="" :defaultValue="request()->input('mulai')"></x-text-field>
            <span style="font-size: 14px; color: rgba(0, 0, 0, 0.4);">➜</span>
            <x-text-field type="date" name="sampai" placeholder=""
              :defaultValue="request()->input('sampai')"></x-text-field>
          </div>
        @endif
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
  @if (!$withoutFooter)
    <div class="data-table-footer">
      {{ $footer }}
    </div>
  @endif
</div>

@push('scripts')
  <script src="{{ asset('js/event/search.js') }}"></script>
@endpush