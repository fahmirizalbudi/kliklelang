@props(['placeholder', 'name', 'id' => null, 'defaultValue' => null, 'disabled' => false, 'onChange' => null])

<select id="{{ $id ?? $name }}" name="{{ $name }}">
  <option value="" disabled selected hidden style="display: none">{{ $placeholder }}</option>
  {{ $slot }}
</select>

@push('scripts')
  <script>
    new DynamicSelect('#{{ $id ?? $name }}', {
      name: '{{ $name }}',
      placeholder: '{{ $placeholder }}',
      value: '{{ $defaultValue }}',
      onChange: function (value, text, option) {
        {{ $onChange }}
      }
    });


    @if ($disabled)
      document.querySelector('#{{ $id ?? $name }}').classList.add('disabled');
    @endif
  </script>
@endpush