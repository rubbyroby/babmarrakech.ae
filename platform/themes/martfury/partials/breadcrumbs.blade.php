<ul class="breadcrumb">
    @foreach ($crumbs = Theme::breadcrumb()->getCrumbs() as $i => $crumb)
        @if ($i != (count($crumbs) - 1))
            <li>
                <a href="{{ $crumb['url'] }}" itemprop="item" style="color: white;">{!! BaseHelper::clean($crumb['label']) !!}</a>
                <span class="extra-breadcrumb-name"></span>
            </li>
        @else
            <li aria-current="page" style="color: white;">
                <span>{!! BaseHelper::clean($crumb['label']) !!}</span>
            </li>
        @endif
    @endforeach
</ul>
