<?php

use App\Http\Middleware\AdminAuthMiddleware;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => config('web.prefix'), 'namespace' => 'App\Http\Controllers\Web'], function () {
    Route::controller(WebController::class)->group(function () {
        Route::get('/', 'index')->name('home');
        Route::get('/page/{page}', 'page')->name('page');
    });

    Route::controller(InstallController::class)->group(function () {
        Route::get('/installation', 'installation')->name('installation');
        Route::post('/install', 'install')->name('install');
    });

});

Route::group(['prefix' => 'admin', 'namespace' => 'App\Http\Controllers\Web\Admin'], function () {
    Route::controller(AuthController::class)->group(function () {
        Route::get('/sign-up', 'sign_up')->name('admin.auth.sign-up');
        Route::post('/sign-up', 'sign_up')->name('admin.sign-up');
        Route::get('/', 'sign_in')->name('admin.auth.sign-in');
        Route::post('/sign-in', 'sign_in')->name('admin.sign-in');
        Route::get('/sign-out', 'sign_out')->name('admin.sign-out');

        Route::middleware(AdminAuthMiddleware::class)->group(function () {
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

            Route::group(['prefix' => 'plugin'], function () {
                Route::controller(PluginController::class)->group(function () {
                    Route::get('/', 'index')->name('admin.plugin');
                });
            });

            Route::group(['prefix' => 'notification'], function () {
                Route::controller(NotificationController::class)->group(function () {
                    Route::get('/', 'index')->name('admin.notification');
                });
            });

            Route::group(['prefix' => 'backup'], function () {
                Route::controller(BackupController::class)->group(function () {
                    Route::get('/', 'index')->name('admin.backup.index');
                    Route::get('/backup', 'backup')->name('admin.backup.create');
                    Route::get('/download/{id}', 'download')->name('admin.backup.download');
                });
            });
        });
    });
});
