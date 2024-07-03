<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
<div class="ps-page--shop">
    <div @if (Route::currentRouteName() == 'public.products') id="app" @endif>
        @if (theme_option('show_featured_brands_on_products_page', 'yes') == 'yes' &&  Route::currentRouteName() == 'public.products')
            <div class="mt-40">
                <div class="ps-shop-brand">
                    @foreach(get_featured_brands() as $brand)
                        @if($brand->logo && $brand->logo !== "NULL")
                            <a href="{{ $brand->website }}">
                                <img src="{{ RvMedia::getImageUrl($brand->logo, null, false, RvMedia::getDefaultImage()) }}" alt="{{ $brand->name }}" loading="lazy"/>
                            </a>
                        @endif
                    @endforeach
                </div>
            </div>
        @endif
        <div class="ps-layout--shop">
            <div class="ps-layout__left">
                <div class="screen-darken"></div>
                <div class="ps-layout__left-container">
                    <div class="ps-filter__header d-block d-xl-none">
                        <h3>{{ __('Filter Products') }}</h3><a class="ps-btn--close ps-btn--no-border" href="#"></a>
                    </div>
                    <div class="ps-layout__left-content">
                        <form action="{{ URL::current() }}" data-action="{{ route('public.products') }}" method="GET" id="products-filter-form">
                            @include(Theme::getThemeNamespace() . '::views.ecommerce.includes.filters')
                        </form>
                    </div>
                </div>
            </div>
            <div class="ps-layout__right">
                @if (theme_option('show_recommend_items_on_products_page', 'yes') == 'yes' && Route::currentRouteName() == 'public.products')
                    <div class="ps-block--shop-features">
                        <div class="ps-block__header">
                            <h3>{{ __('Recommended Items') }}</h3>
                            <div class="ps-block__navigation">
                                <a class="ps-carousel__prev" href="#recommended-products">
                                    <i class="icon-chevron-left"></i>
                                </a>
                                <a class="ps-carousel__next" href="#recommended-products">
                                    <i class="icon-chevron-right"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ps-block__content">
                            <div class="ps-section__content">
                                <div class="ps-carousel--responsive owl-slider"
                                     data-owl-auto="true"
                                     data-owl-loop="false"
                                     data-owl-speed="10000"
                                     data-owl-gap="0"
                                     data-owl-nav="false"
                                     data-owl-dots="true"
                                     data-owl-item="4"
                                     data-owl-item-xs="2"
                                     data-owl-item-sm="2"
                                     data-owl-item-md="3"
                                     data-owl-item-lg="4"
                                     data-owl-item-xl="4"
                                     data-owl-duration="1000"
                                     data-owl-mousedrag="on"
                                >
                                    @foreach(get_featured_products() as $product)
                                        <div class="ps-product">
                                            {!! Theme::partial('product-item', compact('product')) !!}
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                
@php

 [$categories] =
EcommerceHelper::dataForFilter($category ?? null);


$subcategories = [];
    foreach ($categories as $category) {
        if ($category->parent_id != 0) {
            $subcategories[] = $category;
        }
    }

@endphp
                 <div class="row">
                    <div class="col-12">
                        <div class="partner-container py-3 text-center">
                            <section>
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="owl-carousel owl-theme">
                                            @foreach($subcategories as $subcategory)
                                                @if($subcategory->icon_image != '')
                                                    @if(__("I'm shopping for...") == "I'm shopping for...")
                                                        <div class="item">
                                                            <a href="https://babmarrakesh.ae/product-categories/{{ str_replace('product-categories/', '', $subcategory->url) }}">
                                                                <img src="{{ url('/storage/' . $subcategory->icon_image) }}" alt="{{ $subcategory->name }}" style="max-width : 150px !important;">
                                                            </a>
                                                        </div>
                                                    @else
                                                    @php
                                                        $url = $subcategory->icon_image;

                                                        // Extract the path and filename from the URL
                                                        $pathInfo = pathinfo($url);

                                                        // Append '-ar' to the filename
                                                        $newFilename = $pathInfo['filename'] . '-ar';

                                                        // Build the new URL with the modified filename
                                                        $newUrl = $pathInfo['dirname'] . '/' . $newFilename . '.' . $pathInfo['extension'];

                                                    @endphp
                                                        <div class="item">
                                                            <a href="{{ str_replace('product-categories/', '', $subcategory->url) }}">
                                                            <img src="{{ url('/storage/' . $newUrl) }}" alt="{{ $subcategory->name }}" style="max-width : 150px !important;">
                                                            </a>
                                                        </div>
                                                    @endif
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>

                <div class="ps-shopping ps-tab-root">
                    <div class="bg-light py-2 mb-3">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 col-sm-6 col-md-3 d-xl-none px-2 px-sm-3">
                                    <div class="header__filter d-xl-none mx-auto mb-3 mb-sm-0">
                                        <button id="products-filter-sidebar" type="button">
                                            <i class="icon-equalizer"></i><span class="ml-2">{{ __('Filter') }}</span>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-12 col-md-3 col-xl-6 d-none d-md-block">
                                    <div class="products-found pt-3">
                                        <strong>{{ $products->total() }}</strong><span class="ml-1">{{ __('Products found') }}</span>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 px-2 px-sm-3">
                                    <div class="d-flex justify-content-center justify-content-sm-end">
                                        @include(Theme::getThemeNamespace() . '::views/ecommerce/includes/sort')
                                        <div class="ps-shopping__view ml-2">
                                            <ul class="products-layout mb-0 p-0">
                                                <li @if (request()->get('layout') != 'list') class="active" @endif><a href="#grid" data-layout="grid"><i class="icon-grid"></i></a></li>
                                                <li @if (request()->get('layout') == 'list') class="active" @endif><a href="#list" data-layout="list"><i class="icon-list4"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ps-tabs ps-products-listing">
                        @include(Theme::getThemeNamespace('views.ecommerce.includes.product-items'))
                        {!! apply_filters('ecommerce_after_product_listing') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    $('.owl-carousel').owlCarousel({
    loop:true,
    margin:10,
    nav:true,
    rtl: true,
    items: 5,
    lazyLoad: true,
    responsive:{
        0:{
            items:3
        },
        600:{
            items:5
        },
        1000:{
            items:7
        }
    }
})
</script>

