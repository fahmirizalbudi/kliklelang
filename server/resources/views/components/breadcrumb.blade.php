@props(['groupPage', 'currentPage'])

<div class="content-breadcrumb">
  <h2 class="breadcrumb-active">{{ $currentPage }}</h2>
  <nav>
    <ul class="breadcrumb-navigation">
      <li class="breadcrumb-navigation-item">
        <a href="#" class="breadcrumb-navigation-item-title">
          {{ $groupPage }}
          <x-icon name="breadcrumb"></x-icon>
        </a>
      </li>
      <li class="breadcrumb-navigation-item-current">{{ $currentPage }}</li>
    </ul>
  </nav>
</div>