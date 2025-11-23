@props(['title', 'withAdd' => null, 'withAddText' => null, 'items' => []])

<div class="overview-card">
  <div class="overview-card-header">
    <div>
      <h2 class="overview-card-title">{{ $title }}</h2>
    </div>
    <div>
      @if ($withAdd)
        <a href="{{ $withAdd }}" class="add-button">
          <x-icon name="add"></x-icon>
          {{ $withAddText }}
        </a>
      @endif
    </div>
  </div>
  <div class="overview-card-content">
    @foreach ($items as $item)
      <div class="card-content">
        <p class="card-content-title">{{ $item['title'] }}</p>
        <h3 class="card-content-value">{{ $item['value'] }}</h3>
      </div>
    @endforeach
  </div>
</div>