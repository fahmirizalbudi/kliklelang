@props(['icon' => null, 'placeholder', 'type' => 'text', 'name', 'id' => null, 'defaultValue' => null])

<div class="form-action-input">
  @if ($icon)
    <span class="form-action-input-icon">
      <x-icon name="{{ $icon }}"></x-icon>
    </span>
  @endif
  <input type="{{ $type }}" name="{{ $name }}" id="{{ $id ?? $name }}"
    class="form-action-input-text {{ $icon ? 'with-icon' : '' }}" placeholder="{{ $placeholder }}"
    value="{{ $defaultValue }}">
</div>