@props(['actionTo', 'method', 'icon', 'color'])

<form action="{{ $actionTo }}" method="POST">
  @csrf
  @method($method)
  <button class="custom-action" style="color: {{ $color }}" type="submit">
    <x-icon name="{{ $icon }}"></x-icon>
    {{ $slot }}
  </button>
</form>