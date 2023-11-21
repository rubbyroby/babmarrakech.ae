<div class="ps-page--shop">
    <div @if (Route::currentRouteName() == 'public.products') id="app" @endif>
        @if (theme_option('show_featured_brands_on_products_page', 'yes') == 'yes' &&  Route::currentRouteName() == 'public.products')
            <div class="mt-40">
                <div class="ps-shop-brand">
                    @foreach(get_featured_brands() as $brand)
                        <a href="{{ $brand->website }}">
                            <img src="{{ RvMedia::getImageUrl($brand->logo, null, false, RvMedia::getDefaultImage()) }}" alt="{{ $brand->name }}" loading="lazy"/>
                        </a>
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
                                     data-owl-item="7"
                                     data-owl-item-xs="2"
                                     data-owl-item-sm="2"
                                     data-owl-item-md="3"
                                     data-owl-item-lg="4"
                                     data-owl-item-xl="6"
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
                    <div class="row">
                        <div class="col-2">
                        </div>
                        <div class="col-8" style="margin-bottom: 1em;">
                        <div id="horizontal-nav">
                          <div class="btn-prev" role="button" tabindex="0">
                            <svg viewBox="0 0 24 24">
                              <path d="M8.59,16.59L13.17,12L8.59,7.41L10,6l6,6l-6,6L8.59,16.59z" fill="hsl(141, 15%, 50%)">
                              </path>
                            </svg>
                          </div>
                          <div class="menu-wrap">
                            <ul class="menu">
                              <li class="list-item">
                                <a href="" class="pill">&nbsp;&nbsp;&nbsp;Sub Categorie 1</a>
                              </li>
                              <li class="list-item">
                                <a class="pill" href="#">Sub Categorie 2</a>
                              </li>
                              <li class="list-item">
                                <a class="pill">Sub Categorie 3</a>
                              </li>
                              <li class="list-item">
                                <a class="pill" href="">Sub Categorie 4</a>
                              </li>
                            </ul>
                          </div>
                          <div class="btn-next" role="button">
                            <svg viewBox="0 0 24 24">
                              <path d="M8.59,16.59L13.17,12L8.59,7.41L10,6l6,6l-6,6L8.59,16.59z" fill="hsl(141, 15%, 50%)">
                              </path>
                            </svg>
                          </div>
                        </div>
                    </div>
                        <div class="col-2">
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
