<?php

use App\Http\Middleware\CheckVisitorSession;
use App\Http\Middleware\CheckVisitorExpiration;
use App\Http\Middleware\UpdateLastSeen;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\Admin;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {

        $middleware->web(append: [
            UpdateLastSeen::class
        ]);

        $middleware->alias([
            'admin' => Admin::class,
            'authVisitor' => CheckVisitorSession::class,
            'expiredVisitor' => CheckVisitorExpiration::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
