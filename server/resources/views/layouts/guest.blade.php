<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>@yield('title')</title>
  <link rel="stylesheet" href="{{ asset('css/global.css') }}">
  <link rel="stylesheet" href="{{ asset('css/components/text-field.css') }}">
  <link rel="stylesheet" href="{{ asset('vendor/flasher/flasher.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendor/flasher/flasher-sweetalert.min.css') }}">
  <link rel="icon" type="image/svg+xml" href="{{ asset('brand.svg') }}">
  @stack('styles')
</head>

<body>
  <div class="app">@yield('content')</div>
  <script src="{{ asset('vendor/flasher/flasher.min.js') }}"></script>
  <script src="{{ asset('vendor/flasher/flasher-sweetalert.min.js') }}"></script>
  @stack('scripts')
</body>

</html>