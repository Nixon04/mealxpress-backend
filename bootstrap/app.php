<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\LoginSessions;
use Inertia\Middleware as HandleInertiaRequests;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        channels: __DIR__.'/../routes/channels.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Apply LoginSessions middleware only to routes that require authentication
        $middleware->web(append: [
            \Inertia\Middleware::class,  // Correct Inertia middleware
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
        // $exceptions->respond(function (Response $response) {
        //     if ($response->getStatusCode() === 419) {
        //         return back()->with([
        //             'message' => 'The page expired, please try again.',
        //         ]);
        //     }
    
        //     return $response;
        // });
    })
    ->create();

