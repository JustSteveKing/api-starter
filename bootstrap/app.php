<?php

declare(strict_types=1);

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(
    basePath: dirname(__DIR__),
)->withRouting(
    api: __DIR__ . '/../routes/api/routes.php',
    commands: __DIR__ . '/../routes/console/routes.php',
    health: '/up',
    apiPrefix: '',
)->withMiddleware(
    callback: function (Middleware $middleware): void {},
)->withExceptions(
    using: function (Exceptions $exceptions): void {},
)->create();
