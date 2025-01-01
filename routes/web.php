<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => config('web.prefix'), 'namespace' => 'App\Http\Controllers\Web'], function () {
    Route::controller(WebController::class)->group(function () {
        Route::get('/', 'index')->name('home');
        Route::get('/{page}', 'index')->name('page');
    });
});

Route::group(['prefix' => 'admin', 'namespace' => 'App\Http\Controllers\Web\Admin'], function () {

    Route::controller(DashboardController::class)->group(function () {
        Route::get('/dashboard', 'index')->name('admin.dashboard');
    });

    Route::group(['prefix' => 'user'], function () {
        Route::controller(UserController::class)->group(function () {
            Route::get('/', 'index')->name('admin.user');
        });
    });

    Route::group(['prefix' => 'subscription'], function () {
        Route::controller(SubscriptionController::class)->group(function () {
            Route::get('/', 'index')->name('admin.subscription');
            Route::get('/subscription-plan', 'subscription_plan')->name('admin.subscription-plan');
        });
    });

    Route::group(['prefix' => 'login-activity'], function () {
        Route::controller(LoginActivityController::class)->group(function () {
            Route::get('/', 'index')->name('admin.login-activity');
        });
    });

    Route::group(['prefix' => 'policy'], function () {
        Route::controller(PolicyController::class)->group(function () {
            Route::get('/', 'index')->name('admin.policy');
        });
    });

    Route::group(['prefix' => 'notification'], function () {
        Route::controller(NotificationController::class)->group(function () {
            Route::get('/', 'index')->name('admin.notification');
        });
    });
});
