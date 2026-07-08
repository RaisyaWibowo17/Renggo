<?php

use App\Http\Middleware\EnsureUserIsCustomer;
use App\Http\Middleware\EnsureUserIsOwner;
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
            'owner' => EnsureUserIsOwner::class,
            'customer' => EnsureUserIsCustomer::class,
        ]);

        $middleware->web(append: [
            \App\Http\Middleware\LogActivity::class,
        ]);

        $middleware->redirectGuestsTo(fn ($request) => $request->is('owner/*')
            ? route('login.owner')
            : route('login.customer'));
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
