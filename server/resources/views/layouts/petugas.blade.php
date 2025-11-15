<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>@yield('title')</title>
  <link rel="stylesheet" href="{{ asset('css/global.css') }}">
  <link rel="stylesheet" href="{{ asset('css/components/sidebar.css') }}">
  <link rel="stylesheet" href="{{ asset('css/components/appbar.css') }}">
  <link rel="stylesheet" href="{{ asset('css/components/profile-dropdown.css') }}">
  <link rel="stylesheet" href="{{ asset('css/components/breadcrumb.css') }}">
  <link rel="stylesheet" href="{{ asset('css/components/text-field.css') }}">
  <link rel="stylesheet" href="{{ asset('css/components/data-table.css') }}">
  <link rel="stylesheet" href="{{ asset('css/components/actions.css') }}">
  <link rel="stylesheet" href="{{ asset('css/components/form-card.css') }}">
  <link rel="stylesheet" href="{{ asset('css/components/label-field.css') }}">
  <link rel="stylesheet" href="{{ asset('css/components/pagination.css') }}">
  <link rel="stylesheet" href="{{ asset('vendor/flasher/flasher.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendor/flasher/flasher-sweetalert.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendor/sweetalert2/sweetalert2.min.css') }}">
  <link rel="icon" type="image/svg+xml" href="{{ asset('brand.svg') }}">
  @stack('styles')
</head>

<body class="petugas">
  <div class="app">
    <x-sidebar></x-sidebar>
    <x-appbar></x-appbar>
    <main class="main-app">
      @yield('content')
    </main>
  </div>
  <script src="{{ asset('js/components/profile-dropdown.js') }}"></script>
  <script src="{{ asset('vendor/flasher/flasher.min.js') }}"></script>
  <script src="{{ asset('vendor/flasher/flasher-sweetalert.min.js') }}"></script>
  <script src="{{ asset('vendor/sweetalert2/sweetalert2.all.min.js') }}"></script>
  @stack('scripts')
</body>

</html>