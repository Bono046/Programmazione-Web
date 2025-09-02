<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        api: __DIR__.'/../routes/api.php',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias( [
            'isAdmin' => \App\Http\Middleware\IsAdminMiddleware::class,
            'isOrg' => \App\Http\Middleware\IsOrganizationMiddleware::class,
            'prevent.admin.edit' => \App\Http\Middleware\PreventAdminEdit::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
