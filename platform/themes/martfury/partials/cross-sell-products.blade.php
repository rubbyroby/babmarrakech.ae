@if (count($crossSellProducts) > 0)
    <div class="ps-section--default ps-customer-bought mt-60" style="display:none;">
        <div class="ps-section__header text-left pb-0 mb-4">
            <h3 class="mb-2">{{ __('Customers who bought this item also bought') }}</h3>
        </div>
        <div class="ps-section__content">
            <div class="row">
                @php
                    $crossSellProducts->loadMissing(['productLabels']);
                    if (is_plugin_active('marketplace')) {
                        $crossSellProducts->loadMissing(['store', 'store.slugable']);
                    }
                    
                    $limitedCrossSellProducts = $crossSellProducts->take(4);
                @endphp
                @foreach($limitedCrossSellProducts as $crossSellProduct)
                    <!-- Use Bootstrap's responsive classes to set the column size -->
                    <div class="col-12 col-sm-6"> <!-- Adjusted this line for responsiveness -->
                        <div class="ps-product">
                            {!! Theme::partial('product-item', ['product' => $crossSellProduct]) !!}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif
