<div class="ps-product-list mb-60">
    <div class="ps-container">
        <div class="ps-section__header">
            <h3>Our Partners</h3>
        </div>
    </div>
</div>

<div class="ps-container my-3"> <!-- Added ps-container class -->
    <div class="row">
        <div class="col-12">
            <div class="partner-card" style="border-radius: 2em; box-shadow: 0 2px 4px rgb(0 0 0 / 23%);">
                <div class="partner-container py-3 text-center"> <!-- Added text-center class -->
                    <div class="row" style="place-content: center;">
                        @php
                            $count = 0;
                        @endphp
                        @foreach($brands as $brand)
                            @if($brand->logo && $brand->logo !== "NULL")
                                @if($count % 5 == 0)
                                    <div class="w-100 display-none"></div><!--  Add a new row after every 5 logos -->
                                @endif
                                @if($count < 10)
                                    <div class="col-lg-2 col-md-3 col-sm-6 col-6 partner-logo"><a href="/products?brands%5B%5D={{$brand->id}}"><img src="{{ RvMedia::getImageUrl($brand->logo, null, false, RvMedia::getDefaultImage()) }}" alt="{{ $brand->name }}"></a></div>
                                    @php
                                        $count++;
                                    @endphp
                                @endif
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>