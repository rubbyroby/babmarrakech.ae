<div class="mt-40">
    <div class="ps-shop-brand">
        @foreach($brands as $brand)
            <a href="{{ $brand->website }}">
                <img src="{{ RvMedia::getImageUrl($brand->logo, null, false, RvMedia::getDefaultImage()) }}" alt="{{ $brand->name }}" loading="lazy"/>
            </a>
        @endforeach
    </div>
</div>
