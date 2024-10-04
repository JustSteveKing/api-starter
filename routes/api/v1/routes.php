<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

Route::middleware(['throttle:auth'])->prefix('auth')->as('auth:')->group(base_path(
    path: 'routes/api/v1/auth.php',
));
