<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->web(append: [
            \App\Http\Middleware\HandleInertiaRequests::class,
            \Illuminate\Http\Middleware\AddLinkHeadersForPreloadedAssets::class,
        ]);

        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->shouldRenderJsonWhen(
            fn (Request $request) => $request->is('api/*'),
        );
    })->create();

// Vercel read-only filesystem fix
if (isset($_ENV['VERCEL']) || isset($_SERVER['VERCEL'])) {
    $app->useStoragePath('/tmp/storage');
    
    // Create required directories in /tmp
    $paths = ['/framework/views', '/framework/cache/data', '/logs', '/framework/sessions'];
    foreach ($paths as $path) {
        if (!is_dir('/tmp/storage' . $path)) {
            @mkdir('/tmp/storage' . $path, 0777, true);
        }
    }
}

return $app;
