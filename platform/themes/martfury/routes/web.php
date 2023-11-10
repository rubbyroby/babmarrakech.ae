<?php

use Botble\Theme\Facades\Theme;
use Illuminate\Support\Facades\Route;
use Theme\Martfury\Http\Controllers\MartfuryController;

Route::group(['controller' => MartfuryController::class, 'middleware' => ['web', 'core']], function () {
    Route::group(apply_filters(BASE_FILTER_GROUP_PUBLIC_ROUTE, []), function () {
        Route::group(['prefix' => 'ajax', 'as' => 'public.ajax.'], function () {
            Route::get('products', 'ajaxGetProducts')
                ->name('products');

            Route::get('cart', 'ajaxCart')
                ->name('cart');

            Route::get('quick-view/{id}', 'ajaxQuickView')
                ->name('quick-view')
                ->wherePrimaryKey();

            Route::get('product-reviews/{id}', 'ajaxGetProductReviews')
                ->name('product-reviews')
                ->wherePrimaryKey();

            Route::get('search-products', 'ajaxSearchProducts')
                ->name('search-products');

            Route::post('send-download-app-links', 'ajaxSendDownloadAppLinks')
                ->name('send-download-app-links');

            Route::get('products-by-collection/{id}', 'ajaxGetProductsByCollection')
                ->name('products-by-collection')
                ->wherePrimaryKey();

            Route::get('products-by-category/{id}', 'ajaxGetProductsByCategory')
                ->name('products-by-category')
                ->wherePrimaryKey();
        });
    });
});

Theme::routes();
