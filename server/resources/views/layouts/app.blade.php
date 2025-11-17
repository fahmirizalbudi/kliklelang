<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>@yield('title')</title>
  <link rel="stylesheet" href="{{ asset('css/global.css') }}">
  <link rel="stylesheet" href="{{ asset('css/layouts/includes/navigation.css') }}">
  <link rel="stylesheet" href="{{ asset('css/layouts/includes/feed.css') }}">
  <link rel="icon" type="image/svg+xml" href="{{ asset('brand.svg') }}">
  @stack('styles')
</head>

<body class="app">
  @include('layouts.includes.navigation')
  <div class="app-divider"></div>
  <main class="main-app-v2">
    @include('layouts.includes.feed')
    @yield('content')
  </main>
  <script src="{{ asset('vendor/flasher/flasher.min.js') }}"></script>
  <script src="{{ asset('vendor/flasher/flasher-sweetalert.min.js') }}"></script>
  <script src="{{ asset('vendor/sweetalert2/sweetalert2.all.min.js') }}"></script>
  <script src="{{ asset('vendor/dynamic-select/dynamic-select.js') }}"></script>
  @stack('scripts')
</body>

</html>