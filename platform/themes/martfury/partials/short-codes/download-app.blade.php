<div class="ps-download-app">
    <div class="" style="background-image:url('{{ Theme::asset()->url('img/newonebg.png') }}')">
        <div class="ps-block--download-app" style="">
            <div class="container" >
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 ">
                        <div class="ps-block__thumbnail" style="text-align: -webkit-center;">
                            <img src="{{ Theme::asset()->url('img/mobile-app.png') }}" alt="screenshot">
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 ">
                        <div class="ps-block__content">
                            
                            <img src="{{ Theme::asset()->url('img/text.png') }}" alt="screenshot">

                            @if ($androidAppUrl || $iosAppUrl)
                                <div class="row" style="text-align-last: center;">
                                    @if ($androidAppUrl)
                                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                                <a href="{{ (string) $androidAppUrl }}"><img src="{{ Theme::asset()->url('img/Play-store-Button.png') }}" class="img-fluid"  alt="{{ __('Google Play') }}"></a>
                                        </div>
                                    @endif

                                    @if ($iosAppUrl)
                                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                            <a href="{{ (string) $iosAppUrl }}"><img src="{{ Theme::asset()->url('img/App-store-Button.png') }}" class="img-fluid"  alt="{{ __('App Store') }}"></a>
                                        </div>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
