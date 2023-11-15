<?php

use Illuminate\Support\Facades\Route;
use Theme\Martfury\Http\Controllers\MartfuryController;


Route::group(['controller' => MartfuryController::class, 'middleware' => ['api', 'core']], function () {


    Route::get('/test-app-api', function () {
        return response()->json(['message' => 'Hello World']);
    });


});


Theme::routes();