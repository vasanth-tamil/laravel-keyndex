<?php

use Illuminate\Support\Facades\Route;


// USER ROUTES
Route::group(['prefix' => config('api.v1.prefix'), 'namespace' => config('api.v1.namespace')], function () {
    // auth
    Route::group(['prefix' => 'auth'], function () {
        Route::controller(AuthController::class)->group(function () {
            Route::post('/sign-up', 'sign_up');
            Route::post('/sign-in', 'sign_in');
            Route::post('/resend-otp', 'resend_otp');
            Route::get('/verify-token', 'verify_token');
            Route::get('/forget-password', 'forget_password');
        });
    });

    // protected routes
    Route::middleware('auth:sanctum')->group(function () {
        // APP
        Route::group(['prefix' => 'app'], function () {
            Route::controller(AppController::class)->group(function () {
                Route::get('/config', 'config');
                Route::post('/settings', 'save_settings');
                Route::get('/home', 'home');
                Route::get('/search', 'search');
                Route::get('/policy/{type}', 'policy');
            });
        });

        // SUBSCRITONS
        Route::group(['prefix' => 'subscription'], function () {
            Route::controller(SubscriptionController::class)->group(function () {
                Route::get('/', 'index');
                Route::get('/cancel', 'cancel');
                Route::get('/history', 'show_history');
                Route::get('/subscription-plans', 'available_plans');
                Route::get('/{id}', 'show_subscription');
                Route::get('/plan/{id}', 'show');

                // SUBSCRIBE
                Route::post('/subscribe/{id}', 'subscribe');
                Route::post('/upgrade/{id}', 'upgrade');
            });
        });

        // NOTIFICATIONS
        Route::group(['prefix' => 'notifications'], function () {
            Route::controller(NotificationController::class)->group(function () {
                Route::get('/', 'index');
            });
        });

        // LOGIN ACTIVITY
        Route::group(['prefix' => 'activity'], function () {
            Route::controller(LoginActivityController::class)->group(function () {
                Route::get('/', 'index');
                Route::get('/{id}', 'show');
                Route::post('/logout-device/{id}', 'logout_device');
            });
        });

        // USER ACTIONS
        Route::group(['prefix' => 'auth'], function () {
            Route::controller(AuthController::class)->group(function () {
                Route::get('/profile', 'profile');
                Route::post('/profile', 'update_profile');
                Route::post('/verify-otp', 'verify_otp');
                Route::post('/change-password', 'change_password');
                Route::get('/sign-out', 'sign_out');
            });
        });
    });
});
