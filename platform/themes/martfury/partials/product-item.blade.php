@if ($product)

        <div class="product-card home-page-products-card">
            
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
                <a class="add-to-cart-button btn" href="#" data-url="{{ route('public.compare.add', $product->id) }}" title="{{ __('Compare') }}"><img src="https://arabna.shop/storage/compare-icon-1.png" alt="Cart" style="height: 40px;"></a>
            @endif
            @if (EcommerceHelper::isWishlistEnabled())
                <a class="js-add-to-wishlist-button btn" href="#" data-url="{{ route('public.wishlist.add', $product->id) }}" title="{{ __('Add to Wishlist') }}"><img src="https://arabna.shop/storage/love-icon.png" alt="Cart" class="wish_img_btn" style=""></a>
            @endif
            <a class="js-quick-view-button btn"  href="#" data-url="{{ route('public.ajax.quick-view', $product->id) }}" title="{{ __('Quick View') }}"><img src="https://arabna.shop/storage/eye-icon.png" alt="Cart" class="view_product_img_btn" style=""></a>
        </div>

        <a href="{{ $product->url }}">
            <img src="{{ RvMedia::getImageUrl($product->image, 'small', false, RvMedia::getDefaultImage()) }}" style="display: block; position: relative; z-index: 0;" class="card-img-top" alt="{{ $product->name }}">
        </a>
            <hr class="card-divider">
        <div class="card-body">
            @if (EcommerceHelper::isReviewEnabled())
            <div class="rating_wrap">
                <div class="new-rating" style="position: relative; z-index: 2; text-align: center;">
                    <!-- Dynamic star rating based on product review average -->
                    @for ($i = 1; $i <= 5; $i++)
                        @if ($i <= $product->reviews_avg)
                            <i class="fas fa-star"></i> <!-- Filled star -->
                        @else
                            <i class="far fa-star"></i> <!-- Empty star -->
                        @endif
                    @endfor
                </div>
            </div>
        @endif
        

        <div spellcheck="z-index:1;">
            @if (is_plugin_active('marketplace') && $product->store->id)
            <span class="shop-name-title"><a class="shop-name-title" href="{{ $product->store->url }}">{{ $product->store->name }}</a></span>
            @endif

            <a class="ps-product__title" href="{{ $product->url }}" style="color: black;"><h3 class="product-card-title"> <span class="span-product-name">{!! BaseHelper::clean($product->name) !!}</span></h3></a>
            <p class="product-price @if ($product->front_sale_price !== $product->price) sale @endif">{{ format_price($product->front_sale_price_with_taxes) }} @if ($product->front_sale_price !== $product->price) <del>{{ format_price($product->price_with_taxes) }} </del> @endif</p>
        </div>
        <div>
        <a class="btn add-to-basket-btn" id="add-to-basket-btn" data-id="{{ $product->id }}" href="#" data-url="{{ route('public.cart.add-to-cart') }}" style="display: inline-flex; align-items: center; text-decoration: none;"> <img src="https://arabna.shop/storage/shop-icon.png" alt="Shop Icon" style="height: 16px; width: auto; margin-right: 5px;"> Add To Basket </a>
        </div>
        </div>
        </div>

@endif
