<div class="ps-section--shopping ps-shopping-cart pt-40">
    <div class="container">
        <div class="ps-section__header">
            <h1 style="color:black !important">{{ __('Shopping Cart') }}</h1>
        </div>
        <div class="ps-section__content">
            <form class="form--shopping-cart" method="post" action="{{ route('public.cart.update') }}">
                @csrf
                    @if (count($products) > 0)
                            <div class="table-responsive">
                                <table class="table ps-table--shopping-cart">
                                    <thead>
                                    <tr>
                                        <th style="background-color: #205044; color: white; border-top-left-radius: 10px; border-bottom-left-radius: 10px;">{{ __("Product's name") }}</th>
                                        <th style="background-color: #205044; color: white;">{{ __('Price') }}</th>
                                        <th style="background-color: #205044; color: white;">{{ __('Quantity') }}</th>
                                        <th style="background-color: #205044; color: white;">{{ __('Total') }}</th>
                                        <th style="background-color: #205044; color: white; border-top-right-radius: 10px; border-bottom-right-radius: 10px;"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach(Cart::instance('cart')->content() as $key => $cartItem)
                                            @php
                                                $product = $products->find($cartItem->id);
                                            @endphp

                                            @if (!empty($product))
                                            
                                                       <div class="mcart-item card mb-3 shopping-cart-display-mode" style="border: 2px solid #66666687;border-radius: 1em;">
                    <div class="row no-gutters shopping-cart-display-mode justify-center">
                        <div class="col-4 d-flex flex-row justify-content-center">
                            <img src="{{ RvMedia::getImageUrl($cartItem->options['image'], 'thumb', false, RvMedia::getDefaultImage()) }}" class="card-img" alt="{{ $product->original_product->name }}">
                        </div>
                        <div class="mcart-item-details col-8">
                            <div class="mcart-item-body card-body" style="margin-top:0px !important;">
                                <div class=" d-flex flex-row items-content-start ml-10">
                                    <h5 class="mcart-item-title card-title text-start" style="font-size:1.1em !important;color: #205044;white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $product->original_product->name }}</h5>
                                </div>
                                
                                    <p><small>{{ $cartItem->options['attributes'] ?? '' }}</small></p>
                                <div class="row">
                                        <div class="ps-table--shopping-cart col-12 d-flex flex-row align-items-center justify-content-between ml-10 mr-10">
                                            <div>
                                                <span class="mcart-item-text card-text"><small style="font-weight: bold; font-size: 10px;">{{ $product->store->name }}</small></span>
                                            </div>
                                            <div class="form-group--number product__qty col-sm-5">
                                                <button class="up" style="background-color: #D9D9D9; border-radius: 50px; text-align: center">+</button>
                                                <button class="down" style="background-color: #D9D9D9; border-radius: 50px; text-align: center">-</button>
                                                <input type="number" class="form-control qty-input"  style="border: none;" min="1" value="{{ $cartItem->qty }}" title="{{ __('Qty') }}" name="items[{{ $key }}][values][qtyFromMobile]">
                                            </div>
                                        </div>
                                        <div class="col-12 d-flex flex-row justify-content-start ml-10">
                                            <a href="#" data-url="{{ route('public.cart.remove', $cartItem->rowId) }}" class="remove-cart-button"><i class="icon-trash"></i> Remove</a>
                                        </div>
                                        <div class="col-12 d-flex flex-row align-items-center justify-content-center">
                                            <div class="col-6 d-flex flex-column">
                                                <span class="mcart-item-price-label card-text mt-3 d-flex flex-column justify-content-start align-items-start" style="font-size: 1.3em;"><small style="color: black; font-weight: bolder;">Price </small></span>
                                                <span class="mcart-item-price card-text  d-flex flex-column justify-content-start  align-items-start" style="font-weight: bold; color: #205044;">AED {{ format_price($cartItem->price) }}</span>
                                            </div>
                                            <div class="col-6">
                                                <span class="mcart-item-price-label card-text mt-3 d-flex flex-column justify-content-start align-items-start" style="font-size: 1.3em;"><small style="color: black; font-weight: bolder;">Subtotal </small></span>
                                                <span class="mcart-item-price card-text d-flex flex-column justify-content-start  align-items-start" style="font-weight: bold; color: #205044;">AED {{ format_price($cartItem->price * $cartItem->qty) }}</span>
                                            </div>
                                        </div>
                                        
                                        <div class="col-12 d-flex flex-row justify-content-center">
                                        
                                      
                                </div>
                                
                                </div>

                              
                        </div>
                    </div>
                </div>


                                                <tr>
                                                    <td>
                                                        <input type="hidden" name="items[{{ $key }}][rowId]" value="{{ $cartItem->rowId }}">
                                                        <div class="ps-product--cart">
                                                            <div class="ps-product__thumbnail">
                                                                <a href="{{ $product->original_product->url }}">
                                                                    <img src="{{ RvMedia::getImageUrl($cartItem->options['image'], 'thumb', false, RvMedia::getDefaultImage()) }}" alt="{{ $product->original_product->name }}" class="border-rounded" />
                                                                </a>
                                                            </div>
                                                            <div class="ps-product__content">
                                                                <a href="{{ $product->original_product->url }}" style="color: #205044;">{{ $product->original_product->name }}  @if ($product->isOutOfStock()) <span class="stock-status-label">({!! $product->stock_status_html !!})</span> @endif</a>
                                                                @if (is_plugin_active('marketplace') && $product->original_product->store->id)
                                                                    <p class="d-block mb-0 sold-by"><small>{{ __('Sold by') }}: <a
                                                                                href="{{ $product->original_product->store->url }}">{{ $product->original_product->store->name }}</a></small></p>
                                                                @endif

                                                                <p class="mb-0"><small>{{ $cartItem->options['attributes'] ?? '' }}</small></p>

                                                                @if (!empty($cartItem->options['options']))
                                                                    {!! render_product_options_info($cartItem->options['options'], $product, true) !!}
                                                                @endif

                                                                @if (!empty($cartItem->options['extras']) && is_array($cartItem->options['extras']))
                                                                    @foreach($cartItem->options['extras'] as $option)
                                                                        @if (!empty($option['key']) && !empty($option['value']))
                                                                            <p class="mb-0"><small>{{ $option['key'] }}: <strong> {{ $option['value'] }}</strong></small></p>
                                                                        @endif
                                                                    @endforeach
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="price text-center">
                                                        <div class="product__price @if ($product->front_sale_price != $product->price) sale @endif">
                                                            <span>{{ format_price($cartItem->price) }}</span>
                                                            @if ($product->front_sale_price != $product->price)
                                                                <small><del>{{ format_price($product->price) }}</del></small>
                                                            @endif
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="form-group--number product__qty">
                                                            <button class="up">+</button>
                                                            <button class="down">-</button>
                                                            <input type="number" class="form-control qty-input" min="1" value="{{ $cartItem->qty }}" title="{{ __('Qty') }}" name="items[{{ $key }}][values][qty]">
                                                        </div>
                                                    </td>
                                                    <td class="text-center">{{ format_price($cartItem->price * $cartItem->qty) }}</td>
                                                    <td><a href="#" data-url="{{ route('public.cart.remove', $cartItem->rowId) }}" class="remove-cart-button"><i class="icon-cross"></i></a></td>
                                                </tr>
                                                @endif
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                    @else
                        <p class="text-center">{{ __('Your cart is empty!') }}</p>
                    @endif
                </form>
        </div>
        @if (count($products) > 0)
            <div class="ps-section__footer">
                <div class="row">
                    <div class="col-lg-6 col-md-12 form-coupon-wrapper">
                        <figure>
                            <figcaption>{{ __('Coupon Discount') }}</figcaption>
                            <div class="form-group">
                                <input class="form-control coupon-code" type="text" name="coupon_code" value="{{ old('coupon_code') }}" placeholder="{{ __('Enter coupon code') }}">
                            </div>
                            <div class="form-group">
                                <button class="ps-btn ps-btn--outline btn-apply-coupon-code" style="border-radius: 40px; color: white; border: none;" type="button" data-url="{{ route('public.coupon.apply') }}">{{ __('Apply') }}</button>
                            </div>
                        </figure>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12 ">
                        <div class="ps-block--shopping-total border-rounded">
                            <div class="ps-block__header">
                                <p>{{ __('Subtotal') }} <span> {{ format_price(Cart::instance('cart')->rawSubTotal()) }}</span></p>
                            </div>
                            @if (EcommerceHelper::isTaxEnabled())
                                <div class="ps-block__header">
                                    <p>{{ __('Tax') }} <span> {{ format_price(Cart::instance('cart')->rawTax()) }}</span></p>
                                </div>
                            @endif
                            @if ($couponDiscountAmount > 0 && session('applied_coupon_code'))
                                <div class="ps-block__header">
                                    <p>{{ __('Coupon code: :code', ['code' => session('applied_coupon_code')]) }} (<small><a class="btn-remove-coupon-code text-danger" data-url="{{ route('public.coupon.remove') }}" href="javascript:void(0)" data-processing-text="{{ __('Removing...') }}">{{ __('Remove') }}</a></small>)<span> {{ format_price($couponDiscountAmount) }}</span></p>
                                </div>
                            @endif
                            @if ($promotionDiscountAmount)
                                <div class="ps-block__header">
                                    <p>{{ __('Discount promotion') }} <span> {{ format_price($promotionDiscountAmount) }}</span></p>
                                </div>
                            @endif
                            <div class="ps-block__content">
                                <h3 style="color: #205044;">{{ __('Total') }} <span style="color: #205044;">{{ ($promotionDiscountAmount + $couponDiscountAmount) > Cart::instance('cart')->rawTotal() ? format_price(0) : format_price(Cart::instance('cart')->rawTotal() - $promotionDiscountAmount - $couponDiscountAmount) }}</span></h3>
                                <p><small>({{ __('Shipping fees not included') }})</small></p>
                            </div>
                        </div>
                        <a class="ps-btn btn-cart-button-action" href="{{ route('public.products') }}"><i class="icon-arrow-left"></i> {{ __('Back to Shop') }}</a>
                        <a class="ps-btn ps-btn btn-cart-button-action" href="{{ route('public.checkout.information', OrderHelper::getOrderSessionToken()) }}">{{ __('Proceed to checkout') }} <i class="icon-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        @endif

        {!! Theme::partial('cross-sell-products', compact('crossSellProducts')) !!}
    </div>
</div>
