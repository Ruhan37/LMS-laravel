<?php

use App\Http\Middleware\RoleMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {

        $middleware->alias([
            'role' => RoleMiddleware::class
        ]);

        // Redirect guests to login when accessing protected routes
        $middleware->redirectGuestsTo(fn () => route('login'));

        // Global Middleware - Runs on every request
        // CSRF Protection is enabled globally by default
        // This ensures all POST, PUT, PATCH, DELETE requests have valid CSRF token
        $middleware->validateCsrfTokens(except: [
            // Add routes to exclude from CSRF protection (if needed)
            // Example: 'webhook/*', 'api/*'
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
