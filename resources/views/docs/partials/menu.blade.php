<li>
    <a class="{{ request()->is($path) ? 'is-active' : '' }}" href="/{{ $path }}">
        {{ $title }}
    </a>
</li>
