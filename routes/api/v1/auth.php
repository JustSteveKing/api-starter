<?php

declare(strict_types=1);

use App\Http\Controllers\Auth\V1;
use Illuminate\Support\Facades\Route;

Route::post('login', V1\LoginController::class)->name('login');
Route::post('register', V1\RegisterController::class)->name('register');
