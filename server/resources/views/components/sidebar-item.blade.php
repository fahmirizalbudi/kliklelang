@props(['text', 'icon' => null, 'active' => false, 'linkTo' => '#'])

<li>
    <a href="{{ $linkTo }}" class="menu-item {{ $active ? 'active' : '' }}">
        @if ($icon)
            <x-sidebar-icon name="{{ $icon }}" />
        @endif
        <span class="menu-item-text">{{ $text }}</span>
    </a>
</li>