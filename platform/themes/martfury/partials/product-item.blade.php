@if ($product)

        <div class="product-card">
            @if ($product->isOutOfStock())
            <div class="product_badges-tag" style="background-color:red;color:#fff">Out of Stock</div>
            @else
                @if ($product->productLabels->count())
                    @foreach ($product->productLabels as $label)
                    <div class="product_badges-tag" @if ($label->color) style="background-color: {{ $label->color }};color:#fff;" @endif>{{ $label->name }}</div>
                    @endforeach
                @else
                    @if ($product->front_sale_price !== $product->price)
                            <div class="product_badges-tag" style="background-color:red;color:#fff">{{ get_sale_percentage($product->price, $product->front_sale_price) }}</div>
                    @endif
                @endif
            @endif

            <div class="card-product_icons">
            @if (EcommerceHelper::isCompareEnabled())
                <a class="add-to-cart-button btn" href="#" data-url="{{ route('public.compare.add', $product->id) }}" title="{{ __('Compare') }}"><img src="https://tiendamaxima.shop/storage/compare-icon-1.png" alt="Cart" style="height: 40px;"></a>
            @endif
            @if (EcommerceHelper::isWishlistEnabled())
                <a class="js-add-to-wishlist-button btn" href="#" data-url="{{ route('public.wishlist.add', $product->id) }}" title="{{ __('Add to Wishlist') }}"><img src="https://tiendamaxima.shop/storage/love-icon.png" alt="Cart" style="height: 40px;"></a>
            @endif
            <a class="js-quick-view-button btn"  href="#" data-url="{{ route('public.ajax.quick-view', $product->id) }}" title="{{ __('Quick View') }}"><img src="https://tiendamaxima.shop/storage/eye-icon.png" alt="Cart" style="height: 40px;"></a>
        </div>

        <a href="{{ $product->url }}">
            <img src="{{ RvMedia::getImageUrl($product->image, 'small', false, RvMedia::getDefaultImage()) }}" style="display: block; position: relative; z-index: 0;" class="card-img-top" alt="{{ $product->name }}">
        </a>
            <hr class="card-divider">
        <div class="card-body">
            @if (EcommerceHelper::isReviewEnabled())

                <div class="rating" style="position: relative; z-index: 2; text-align: center;">
                    <!-- Three 'filled' stars for a three-star rating -->
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <!-- Two 'empty' stars to complete the five-star scale -->
                    <i class="far fa-star"></i>
                    <i class="far fa-star"></i>
                </div>
            @endif

        <div spellcheck="z-index:1;">
            @if (is_plugin_active('marketplace') && $product->store->id)
            <span class="shop-name-title"><a class="shop-name-title" href="{{ $product->store->url }}">{{ $product->store->name }}</a></span>
            @endif

            <h5 class="product-card-title"><a class="ps-product__title" href="{{ $product->url }}">{!! BaseHelper::clean($product->name) !!}</a></h5>
            <span class="product-country">UAE</span><br>
            <span class="product-dementions">6 X 245 Ml / Pack</span><br>
            <p class="product-price">{{ format_price($product->price_with_taxes) }}</p>
        </div>
        <div>
        <a href="#" class="btn add-to-basket-btn" style="display: inline-flex; align-items: center; text-decoration: none;"> <img src="https://tiendamaxima.shop/storage/shop-icon.png" alt="Shop Icon" style="height: 16px; width: auto; margin-right: 5px;"> Add To Basket </a>
        </div>
        </div>
        </div>

@endif
