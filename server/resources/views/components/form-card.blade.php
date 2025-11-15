@props(['title'])

<div class="form-card">
  <div class="form-card-top">
    <div class="form-card-header">
      <h3 class="form-card-header-text">{{ $title }}</h3>
    </div>
  </div>
  <div class="form-card-content">
    {{ $slot }}
  </div>
</div>