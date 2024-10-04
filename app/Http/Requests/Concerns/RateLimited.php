<?php

declare(strict_types=1);

namespace App\Http\Requests\Concerns;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

/** @mixin FormRequest */
trait RateLimited
{
    /** @throws ValidationException */
    public function ensureIsNotRateLimited(): void
    {
        if ( ! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    public function throttleKey(): string
    {
        return Str::transliterate(
            string: Str::lower(
                value: $this->string('email')->toString(),
            ) . '|' . $this->ip(),
        );
    }
}
