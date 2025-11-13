@props(['text' => null, 'for', 'required' => false])

<label for="{{ $for }}" class="form-action-label">{{ $text }} @if ($required) <span
  class="required-label">*</span>
@endif</label>