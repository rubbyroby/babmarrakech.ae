@php
    [$categories, $brands, $tags, $rand, $categoriesRequest, $urlCurrent, $categoryId, $maxFilterPrice] =
EcommerceHelper::dataForFilter($category ?? null);

    Theme::asset()->usePath()
                ->add('custom-scrollbar-css', 'plugins/mcustom-scrollbar/jquery.mCustomScrollbar.css');
    Theme::asset()->container('footer')->usePath()
                ->add('custom-scrollbar-js', 'plugins/mcustom-scrollbar/jquery.mCustomScrollbar.js', ['jquery']);
@endphp

<aside class="widget widget_shop" style="display:none">
    <h4 class="widget-title">{{ __('Product Categories') }}</h4>
    <div class="widget-product-categories">
        @include(Theme::getThemeNamespace('views.ecommerce.includes.categories'), [
            'categories' => $categories,
            'activeCategoryId' => $categoryId,
            'categoriesRequest' => $categoriesRequest,
            'urlCurrent' => $urlCurrent
        ])
    </div>
</aside>

@if ($brands->isNotEmpty())
    <aside class="widget widget_shop">
        <h4 class="widget-title">{{ __('By Brands') }}</h4>
        <figure class="ps-custom-scrollbar">
            @foreach($brands as $brand)
                <div class="ps-checkbox" style="color:#fff !important;border:#fff">
                    <input class="form-control product-filter-item" type="checkbox" name="brands[]" style="color:#fff;border:#fff" id="brand-{{ $rand }}-{{ $brand->id }}" value="{{ $brand->id }}" @if (in_array($brand->id, (array)request()->input('brands', []))) checked @endif>
                    <label class="brand_filterhu" for="brand-{{ $rand }}-{{ $brand->id }}" style="color:#fff !important"><span>{{ $brand->name }} <span class="d-inline-block">({{ $brand->products_count }})</span> </span></label>
                </div>
            @endforeach
        </figure>
    </aside>
@endif



<aside class="widget widget_shop" style="display:none;">
    @if ($maxFilterPrice)
        <h4 class="widget-title">{{ __('By Price') }}</h4>
        <div class="widget__content nonlinear-wrapper">
            <div class="nonlinear" data-min="0" data-max="{{ $maxFilterPrice }}"></div>
            <div class="ps-slider__meta">
                <input class="product-filter-item product-filter-item-price-0" name="min_price" data-min="0" value="{{ BaseHelper::stringify(request()->input('min_price', 0)) }}" type="hidden">
                <input class="product-filter-item product-filter-item-price-1" name="max_price" data-max="{{ $maxFilterPrice }}" value="{{ BaseHelper::stringify(request()->input('max_price', $maxFilterPrice)) }}" type="hidden">
                <span class="ps-slider__value">
                    <span class="ps-slider__min"></span> {{ get_application_currency()->title }}</span> -
                    <span class="ps-slider__value"><span class="ps-slider__max"></span> {{ get_application_currency()->title }}
                </span>
            </div>
        </div>
    @endif

    {!! render_product_swatches_filter([
        'view' => Theme::getThemeNamespace() . '::views.ecommerce.attributes.attributes-filter-renderer'
    ]) !!}
</aside>

<input type="hidden" name="sort-by" class="product-filter-item" value="{{ BaseHelper::clean(request()->input('sort-by')) }}">
<input type="hidden" name="layout" class="product-filter-item" value="{{ BaseHelper::clean(request()->input('layout')) }}">
