<a href="{{ route($route) }}"{!! (\Request::route()->getName() === $route ? ' class="active"' : '') !!}>
    {{ $text }}
</a>