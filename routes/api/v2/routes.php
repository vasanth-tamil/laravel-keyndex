<?php

use Illuminate\Support\Facades\Route;

// USER ROUTES
Route::group(['prefix' => 'v2', 'namespace' => 'App\Http\Controllers\Api\v2'], function () {
    // test
    Route::group(['prefix' => 'test'], function () {
        Route::controller(TestController::class)->group(function () {
            Route::get('/test', 'index');
        });
    });
});
