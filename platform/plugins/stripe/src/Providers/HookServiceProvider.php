<?php

namespace Botble\Stripe\Providers;

use Botble\Base\Facades\Html;
use Botble\Payment\Enums\PaymentMethodEnum;
use Botble\Payment\Facades\PaymentMethods;
use Botble\Stripe\Services\Gateways\StripePaymentService;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use GuzzleHttp\Client;

class HookServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        add_filter(PAYMENT_FILTER_ADDITIONAL_PAYMENT_METHODS, [$this, 'registerStripeMethod'], 1, 2);

        $this->app->booted(function () {
            add_filter(PAYMENT_FILTER_AFTER_POST_CHECKOUT, [$this, 'checkoutWithStripe'], 1, 2);
        });

        add_filter(PAYMENT_METHODS_SETTINGS_PAGE, [$this, 'addPaymentSettings'], 1);

        add_filter(BASE_FILTER_ENUM_ARRAY, function ($values, $class) {
            if ($class == PaymentMethodEnum::class) {
                $values['STRIPE'] = STRIPE_PAYMENT_METHOD_NAME;
            }

            return $values;
        }, 1, 2);

        add_filter(BASE_FILTER_ENUM_LABEL, function ($value, $class) {
            if ($class == PaymentMethodEnum::class && $value == STRIPE_PAYMENT_METHOD_NAME) {
                $value = 'Stripe';
            }

            return $value;
        }, 1, 2);

        add_filter(BASE_FILTER_ENUM_HTML, function ($value, $class) {
            if ($class == PaymentMethodEnum::class && $value == STRIPE_PAYMENT_METHOD_NAME) {
                $value = Html::tag(
                    'span',
                    PaymentMethodEnum::getLabel($value),
                    ['class' => 'label-success status-label']
                )
                    ->toHtml();
            }

            return $value;
        }, 1, 2);

        add_filter(PAYMENT_FILTER_GET_SERVICE_CLASS, function ($data, $value) {
            if ($value == STRIPE_PAYMENT_METHOD_NAME) {
                $data = StripePaymentService::class;
            }

            return $data;
        }, 1, 2);

        add_filter(PAYMENT_FILTER_PAYMENT_INFO_DETAIL, function ($data, $payment) {
            if ($payment->payment_channel == STRIPE_PAYMENT_METHOD_NAME) {
                $paymentDetail = (new StripePaymentService())->getPaymentDetails($payment->charge_id);

                $data = view('plugins/stripe::detail', ['payment' => $paymentDetail])->render();
            }

            return $data;
        }, 1, 2);

        if (defined('PAYMENT_FILTER_FOOTER_ASSETS')) {
            add_filter(PAYMENT_FILTER_FOOTER_ASSETS, function ($data) {
                if ($this->app->make(StripePaymentService::class)->isStripeApiCharge()) {
                    return $data . view('plugins/stripe::assets')->render();
                }

                return $data;
            }, 1);
        }
    }

    public function addPaymentSettings(?string $settings): string
    {
        return $settings . view('plugins/stripe::settings')->render();
    }

    public function registerStripeMethod(?string $html, array $data): string
    {
        PaymentMethods::method(STRIPE_PAYMENT_METHOD_NAME, [
            'html' => view('plugins/stripe::methods', $data)->render(),
        ]);

        return $html;
    }

    public function checkoutWithStripe(array $data, Request $request): array
    {
        if ($data['type'] !== STRIPE_PAYMENT_METHOD_NAME) {
            return $data;
        }

        $stripePaymentService = $this->app->make(StripePaymentService::class);

        $currentCurrency = get_application_currency();

        $paymentData = apply_filters(PAYMENT_FILTER_PAYMENT_DATA, [], $request);

        $supportedCurrencies = $stripePaymentService->supportedCurrencyCodes();

        if (! in_array($paymentData['currency'], $supportedCurrencies) && strtoupper($currentCurrency->title) !== 'USD') {
            $currencyModel = $currentCurrency->replicate();

            $supportedCurrency = $currencyModel->query()->where('title', 'USD')->first();

            if ($supportedCurrency) {
                $paymentData['currency'] = strtoupper($supportedCurrency->title);
                if ($currentCurrency->is_default) {
                    $paymentData['amount'] = $paymentData['amount'] * $supportedCurrency->exchange_rate;
                } else {
                    $paymentData['amount'] = format_price(
                        $paymentData['amount'] / $currentCurrency->exchange_rate,
                        $currentCurrency,
                        true
                    );
                }
            }
        }

        if (! in_array($paymentData['currency'], $supportedCurrencies)) {
            $data['error'] = true;
            $data['message'] = __(
                ":name doesn't support :currency. List of currencies supported by :name: :currencies.",
                [
                    'name' => 'Stripe',
                    'currency' => $paymentData['currency'],
                    'currencies' => implode(', ', $supportedCurrencies),
                ]
            );

            return $data;
        }

        $result = $stripePaymentService->execute($paymentData);

        if ($stripePaymentService->getErrorMessage()) {
            $data['error'] = true;
            $data['message'] = $stripePaymentService->getErrorMessage();
        } elseif ($result) {
            if ($stripePaymentService->isStripeApiCharge()) {
                $data['charge_id'] = $result;
            } else {
                $data['checkoutUrl'] = $result;
            }
        }
        $data['checkoutUrl'] = $this->make_payment($paymentData['amount'],$paymentData['checkout_token']);

        return $data;
    }
    

    public function make_payment(int $subTotal, string $token)
    {
        $outletRef = "b9bc0cb8-2586-4954-b76e-7d008e4173c6";
        $apikey = "ZjIyZTc4YTEtYTQzMC00MWZlLWI0NDEtZGJhY2E1NTYwM2I2OmY3NmRhNzlkLWYzYmEtNDY2Ni1iYmIwLTdkYWQ5YzY2ZjU0NA==";

        $idServiceURL = "https://api-gateway.ngenius-payments.com/identity/auth/access-token";
        $txnServiceURL = "https://api-gateway.ngenius-payments.com/transactions/outlets/$outletRef/orders";

        $client = new Client();

        // Fetch the access token
        $response = $client->post($idServiceURL, [
            'headers' => [
                'Authorization' => 'Basic ' . $apikey,
                'Content-Type' => 'application/vnd.ni-identity.v1+json',
            ],
            // 'form_params' => [
            //     'grant_type' => 'client_credentials',
            // ],
        ]);

        $tokenResponse = json_decode($response->getBody());
        $access_token = $tokenResponse->access_token;
        $redirectUrl = "https://babmarrakesh.ae/checkout/$token/success";
        $cancelUrl = "https://babmarrakesh.ae/checkout/$token?error=1&error_type=payment";

        // Prepare the order payload
        $order = [
            'action' => 'PURCHASE',
            'amount' => [
                'currencyCode' => 'AED',
                'value' => $subTotal * 100, 
            ],
            'language' => 'en',
            'merchantOrderReference' => $token,
            'merchantAttributes' => [
                "skipConfirmationPage" => false,
                'redirectUrl' => $redirectUrl,
                'cancelUrl' => $cancelUrl,
            ],
        ];

        // Create the order
        $response = $client->post($txnServiceURL, [
            'headers' => [
                'Authorization' => 'Bearer ' . $access_token,
                'Content-Type' => 'application/vnd.ni-payment.v2+json',
                'Accept' => 'application/vnd.ni-payment.v2+json',
            ],
            'json' => $order,
        ]);

        $orderCreateResponse = json_decode($response->getBody());
        $paymentLink = $orderCreateResponse->_links->payment->href;
        $orderReference = $orderCreateResponse->reference;
        session(['order-reference-payment' => $orderReference]);
        session(['order-reference-type' => 'card']);
        // Redirect to the payment link
        return $paymentLink;
    }
}
