@props(['text' => null, 'asError' => false, 'asInfo' => false])

@if ($text)
  <p class="message {{ $asError ? 'error' : ($asInfo ? 'info' : null) }}">{{ $text }}</p>
@endif