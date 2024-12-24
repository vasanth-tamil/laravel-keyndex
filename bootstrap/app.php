<?php

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Auth\Sanctum\AuthenticationException;
use Illuminate\Auth\Sanctum\UnauthorizedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\RouteNotFoundException;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;

use App\Http\Middleware\CheckSubscriberMiddleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // middlewares
        $middleware->alias([
            'CheckSubscriberMiddleware' => CheckSubscriberMiddleware::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (ValidationException $e, Request $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'code' => 400,
                    'error' => $e->errors()
                ], 400);
            }
        });

        $exceptions->render(function (NotFoundHttpException $e, Request $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'code' => 404,
                    'error' => 'Record not found.'
                ], 404);
            }
        });

        $exceptions->render(function (MethodNotAllowedHttpException $e, Request $request) {
            return response()->json([
                'code' => 405,
                'error' => 'Method Not Allowed'
            ], 405);
        });

        $exceptions->renderable(function (Server $e, Request $request) {
            return response()->json([
                'code' => 500,
                'error' => 'Method Not Allowed'
            ], 500);
        });

        // authentication exception
        $exceptions->render(function (Throwable $e, Request $request) {
            if ($request->is('api/*')) {
                if (Str::contains($e->getMessage(), 'login')) {
                    return response()->json([
                        'code' => 401,
                        'error' => 'Unauthenticated.'
                    ], 401);
                }
            }
        });
    })->create();
