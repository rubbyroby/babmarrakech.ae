<footer class="ps-footer" style="background-image:url('https://babmarrakesh.ae/storage/website-assets/green-footer-bg.png')">
    <div class="ps-container">
        <div class="ps-footer__widgets">
            <div class="col-3" style="">
                <div class="row">
                    <div class="col-12" style="margin-bottom:2em;margin-top: -34px;">
                        <img src="{{URL::to('/storage/logooo-1.png')}}" alt="Descriptive Alt Text"
                            class="img-fluid">
                    </div>
                    <!-- Empty col-6 space on the right -->
                    <div class="col-6"></div>
                </div>
                <!-- Row for social media icons -->
                <div class="row justify-content-center">
                    <div class="col-12  text-center">
                        <p style="font-family: cursive;color:white;font-size:20px;">Follow, Like, Say Hello To Us</p>
                    </div>
                    <div class="col-2 p-1">
                        <a href="https://web.facebook.com/profile.php?id=100094470649113" target="_blank" rel="noopener noreferrer">
                            <img src="{{URL::to('/storage/facebook-logo.png')}}" alt="Facebook" class="img-fluid">
                        </a>
                    </div>
                    <div class="col-2 p-1">
                        <a href="https://www.instagram.com/babmarrakeshmarket/" target="_blank" rel="noopener noreferrer">
                            <img src="{{URL::to('/storage/instagram-logo.png')}}" alt="Instagram" class="img-fluid">
                        </a>
                    </div>
                    <!--<div class="col-2 p-1">-->
                    <!--    <img src="https://arabna.shop/storage/linkdin-logo.png" alt="LinkedIn" class="img-fluid">-->
                    <!--</div>-->
                    <!--<div class="col-2 p-1">-->
                    <!--    <img src="https://arabna.shop/storage/twitter-logo.png" alt="Twitter" class="img-fluid">-->
                    <!--</div>-->
                    <div class="col-12 text-center" style="font-family: Neoradical;">
                        <p class="instagram_user" style="color: #fff; font-family: Neoradical; font-size: 34px;">
                            @BabMarrakech</p>
                    </div>

        
                </div>
                <div class="col-12">
                    <span class="download-our-app-text">Download our app</h2>
                </div>
                <div class="row download-apps" style="text-align-last: center;">
                    <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                        <a href="https://play.google.com/store/apps/details?id=com.bab.marrakesh"><img src="{{ Theme::asset()->url('img/Play-store-Button.png') }}" class="img-fluid"
                                alt="Google Play"></a>
                    </div>
                    <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                        <a href="https://apps.apple.com/us/app/bab-marrakesh-%D9%85%D9%86%D8%AA%D8%AC%D8%A7%D8%AA-%D9%85%D8%BA%D8%B1%D8%A8%D9%8A%D8%A9/id6476442705"><img src="{{ Theme::asset()->url('img/App-store-Button.png') }}" class="img-fluid"
                                alt="App Store"></a>
                    </div>
                </div>

            </div>


            {!! dynamic_sidebar('footer_sidebar') !!}
        </div>

        <div class="ps-footer__copyright">
            <p style="color: white;">{{ theme_option('copyright') }}</p>
            @php $paymentMethods = array_filter(json_decode(theme_option('payment_methods', []), true)); @endphp
            @if ($paymentMethods)
            <div class="footer-payments">
                <span class="payment-method-title">{{ __('We Using Safe Payment For') }}:</span>
                <p class="d-sm-inline-block d-block">
                    @if (theme_option('payment_methods_link'))
                    <a href="{{ url(theme_option('payment_methods_link')) }}" target="_blank">
                        @endif
                        <span><img src="{{ RvMedia::getImageUrl('general/payment-method-3.jpg') }}" alt="payment method"></span>
                        <span><img src="{{ RvMedia::getImageUrl('general/payment-method-5.jpg') }}" alt="payment method"></span>
                        <span><img src="{{ RvMedia::getImageUrl('cash-on-delivery-2.png') }}" alt="payment method"></span>
                        @if (theme_option('payment_methods_link'))
                    </a>
                    @endif
                </p>
            </div>
            @endif
    
        </div>
    </>
</footer>

@if (is_plugin_active('newsletter') && theme_option('enable_newsletter_popup', 'yes') === 'yes')
<div data-session-domain="{{ config('session.domain') ?? request()->getHost() }}"></div>
<div class="ps-popup" id="subscribe" data-time="{{ (int)theme_option('newsletter_show_after_seconds', 10) * 1000 }}">
    <div class="ps-popup__content bg--cover"
        data-background="{{ RvMedia::getImageUrl(theme_option('newsletter_image')) }}"
        style="background-size: cover!important; boredr-radius: 15px;"><a class="ps-popup__close border-rounded-lg subscribe-close-btn" href="#"><i class="icon-cross"></i></a>
        <form method="post" action="{{ route('public.newsletter.subscribe') }}"
            class="ps-form--subscribe-popup newsletter-form">
            @csrf
            <div class="ps-form__content d-flex flex-column justify-content-center">
                <!--<h4 class="text-white">{{ __('Get 25% Discount') }}</h4>-->
                <p class="text-white">{{ __('Subscribe to the mailing list to receive updates on new arrivals, special offers and our
                    promotions.') }}</p>
                <div class="form-group">
                    <input class="form-control border-rounded-lg" name="email" type="email" placeholder="{{ __('Email Address') }}"
                        required>
                </div>

                @if (setting('enable_captcha') && is_plugin_active('captcha'))
                <div class="form-group">
                    {!! Captcha::display() !!}
                </div>
                @endif

                <div class="form-group">
                    <button class="ps-btn subscribe-btn" type="submit" style="width: 100%;">{{ __('Subscribe') }}</button>
                </div>
                <div class="ps-checkbox">
                    <input class="form-control" type="checkbox" id="dont_show_again" name="dont_show_again">
                    <label for="dont_show_again" class="text-white">{{ __("Don't show this popup again") }}</label>
                </div>
            </div>
        </form>
    </div>
</div>
@endif

{!! Theme::get('bottomFooter') !!}

<div id="back2top"><i class="icon icon-arrow-up"></i></div>
<div class="ps-site-overlay"></div>
@if (is_plugin_active('ecommerce'))
<div class="ps-search" id="site-search"><a class="ps-btn--close" href="#"></a>
    <div class="ps-search__content">
        <form class="ps-form--primary-search" action="{{ route('public.products') }}"
            data-ajax-url="{{ route('public.ajax.search-products') }}" method="get">
            <input class="form-control input-search-product" name="q"
                value="{{ BaseHelper::stringify(request()->query('q')) }}" type="text" autocomplete="off"
                placeholder="{{ __('Search for...') }}">
            <div class="spinner-icon">
                <i class="fa fa-spin fa-spinner"></i>
            </div>
            <button><i class="aroma-magnifying-glass"></i></button>
            <div class="ps-panel--search-result"></div>
        </form>
    </div>
</div>
@endif
<div class="modal fade" id="product-quickview" tabindex="-1" role="dialog" aria-labelledby="product-quickview"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content"><span class="modal-close" data-dismiss="modal"><i class="icon-cross2"></i></span>
            <article class="ps-product--detail ps-product--fullwidth ps-product--quickview">
            </article>
        </div>
    </div>
</div>

<script>
    window.trans = {
        "View All": "{{ __('View All') }}",
        "No reviews!": "{{ __('No reviews!') }}",
    };
</script>

{!! Theme::footer() !!}

@if (session()->has('success_msg') || session()->has('error_msg') || (isset($errors) && $errors->count() > 0) ||
isset($error_msg))
<script type="text/javascript">
    window.onload = function () {
        @if (session() -> has('success_msg'))
            window.showAlert('alert-success', '{{ session('success_msg') }}');
        @endif

        @if (session() -> has('error_msg'))
            window.showAlert('alert-danger', '{{ session('error_msg') }}');
        @endif

        @if (isset($error_msg))
            window.showAlert('alert-danger', '{{ $error_msg }}');
        @endif

        @if (isset($errors))
            @foreach($errors -> all() as $error)
        window.showAlert('alert-danger', '{!! $error !!}');
        @endforeach
        @endif
    };
</script>
@endif
</body>

</html>