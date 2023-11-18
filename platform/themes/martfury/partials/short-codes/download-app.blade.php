<div class="ps-download-app">
    <div style="background-image:url('{{ Theme::asset()->url('img/newonebg.png') }}');">
        <div class=" row justify-content-center " style="padding: 40px 0px;">
            <div class="container">
                <div class=" row">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                        <div class="ps-block__thumbnail" style="text-align: -webkit-center;">
                            <img src="{{ Theme::asset()->url('img/mobile-app.png') }}" alt="screenshot" height="350px">
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                        <div class="ps-block__content  row justify-content-center">

                            <img class="col-sm-6 col-xs-6" src="{{ Theme::asset()->url('img/text.png') }}" alt="screenshot" height="100px"
                                width="200px">

                            @if ($androidAppUrl || $iosAppUrl)
                            <div class="row" style="text-align-last: center;">
                                @if ($androidAppUrl)
                                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                    <a href="{{ (string) $androidAppUrl }}"><img
                                            src="{{ Theme::asset()->url('img/Play-store-Button.png') }}"
                                            class="img-fluid" alt="{{ __('Google Play') }}" height="100px"
                                            width="200px"></a>
                                </div>
                                @endif

                                @if ($iosAppUrl)
                                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                    <a href="{{ (string) $iosAppUrl }}"><img
                                            src="{{ Theme::asset()->url('img/App-store-Button.png') }}"
                                            class="img-fluid" alt="{{ __('App Store') }}" height="100px"
                                            width="200px"></a>
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