@props(['title'])

<section class="group-item">
  <h4 class="group-title">{{ $title }}</h4>
  <ul class="group-item-menus">
    {{ $slot }}
  </ul>
</section>