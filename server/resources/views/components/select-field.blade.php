@props(['placeholder', 'name', 'id' => null, 'defaultValue' => null])

<div class="form-action-select">
  <select name="{{ $name }}" id="{{ $id ?? $name }}" class="form-action-select-input" value="{{ $defaultValue }}"
    required>
    <option value="" class="placeholder">{{ $placeholder }}</option>
    {{ $slot }}
  </select>
  <span class="form-action-select-icon">
    <svg class="stroke-current" width="20" height="20" viewBox="0 0 20 20" fill="#fff"
      xmlns="http://www.w3.org/2000/svg">
      <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke="currentColor" stroke-width="1.5"
        stroke-linecap="round" stroke-linejoin="round"></path>
    </svg>
  </span>
</div>

@push('scripts')
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      document.getElementById('{{ $name ?? $id }}').value = '{{ $defaultValue }}'
    })
  </script>
@endpush