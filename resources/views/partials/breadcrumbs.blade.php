
    @if ($breadcrumbs)
        <nav class="breadcrumbs">
            @foreach ($breadcrumbs as $breadcrumb)
                @if (!$breadcrumb->last)
                    <a class="current" href="#">{{ $breadcrumb->title }}</a>
                @else
                    <a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a>
                @endif
            @endforeach
        </nav>
@endif
