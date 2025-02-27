@if ($product)

        <div class="product-card home-page-products-card" style="background-color: white;">
            
            @if ($product->isOutOfStock())
            <div class="product_badges-tag" style="background-color: red !important;color:#fff !important; border-radius: 8px; top: 4px; left: 4px; font-size: 1rem; box-shadow: 0 3px 8px rgba(0,0,0,.05);">Out of Stock</div>
            @else
                @if ($product->productLabels->count())
                    @foreach ($product->productLabels as $label)
                    <div class="product_badges-tag" @if ($label->color) style="background-color: {{ $label->color }} !important;color:#fff !important; border-radius: 8px; top: 4px; left: 4px; font-size: 1rem;  box-shadow: 0 3px 8px rgba(0,0,0,.05);" @endif>{{ $label->name }} is here</div>
                    @endforeach
                @else
                    @if ($product->front_sale_price !== $product->price)
                            <div class="product_badges-tag" style="left: 4px; top: 4px; font-size: 14px; font-weight: bold;">{{ get_sale_percentage($product->price, $product->front_sale_price) }}</div>
                    @endif
                @endif
            @endif

            <div class="card-product_icons">
            @if (EcommerceHelper::isCompareEnabled())
                <a class="add-to-cart-button btn" href="#" data-url="{{ route('public.compare.add', $product->id) }}" title="{{ __('Compare') }}"><img src="https://arabna.shop/storage/compare-icon-1.png" alt="Cart" style="height: 40px;"></a>
            @endif
            @if (EcommerceHelper::isWishlistEnabled())
                <a class="js-add-to-wishlist-button btn" href="#" data-url="{{ route('public.wishlist.add', $product->id) }}" title="{{ __('Add to Wishlist') }}"><img src="{{URL::to('/storage/love-icon.png')}}" alt="Cart" class="wish_img_btn" style="width: 30px; height: 30px;"></a>
            @endif
            <a class="js-quick-view-button btn"  href="#" data-url="{{ route('public.ajax.quick-view', $product->id) }}" title="{{ __('Quick View') }}"><img src="{{URL::to('/storage/eye-icon.png')}}" alt="Cart" class="view_product_img_btn" style="width: 30px; height: 30px;"></a>
        </div>

        <a href="{{ $product->url }}">
            <img src="{{ RvMedia::getImageUrl($product->image, 'small', false, RvMedia::getDefaultImage()) }}" style="display: block; position: relative; z-index: 0;" class="card-img-top" alt="{{ $product->name }}">
        </a>
            <hr class="card-divider" style="height: 0.25px; margin: 0px 0px;">
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
            <span class="shop-name-title"><a class="shop-name-title" href="{{ url('/products') }}?brands%5B%5D={{ $product->brand_id }}">{{ $product->brand->name }}</a></span>

            <a class="ps-product__title" href="{{ $product->url }}" style="color: black;"><h3 class="product-card-title"> <span class="span-product-name">{!! BaseHelper::clean($product->name) !!}</span></h3></a>
            <p class="product-price @if ($product->front_sale_price !== $product->price) sale @endif" style="color: red; font-size: 28px; margin-top: 0px; font-style: oblique; font-weight: bold; line-height: 1em;"><span style="font-size: 14px; font-weight: 500; font-style: oblique; margin-right: 3px;">AED</span>{{ format_price($product->front_sale_price_with_taxes) }} @if ($product->front_sale_price !== $product->price) <del style="color: rgba(0,0,0,0.5) ;font-size: 14px; font-weight: 500; font-style: oblique;"><span style="margin-right: 3px;">AED</span>{{ format_price($product->price_with_taxes) }} </del> @endif</p>

        </div>
        <div>
        <a class="btn add-to-basket-btn" id="add-to-basket-btn" data-id="{{ $product->id }}" href="#" data-url="{{ route('public.cart.add-to-cart') }}" style="display: inline-flex; align-items: center; text-decoration: none;"> <img src="{{URL::to('/storage/shop-white-icon.png')}}" alt="Shop Icon" style="height: 16px; width: auto; margin-right: 5px;"> Add To Basket </a>
        </div>
        </div>
        </div>

@endif
