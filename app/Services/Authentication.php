<?php

declare(strict_types=1);

namespace App\Services;

use App\Http\Payloads\Auth\V1\LoginPayload;
use App\Http\Payloads\Auth\V1\RegisterPayload;
use App\Models\User;

use Illuminate\Validation\ValidationException;
use Throwable;
use function array_merge;

use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Database\DatabaseManager;
use PHPOpenSourceSaver\JWTAuth\JWTAuth;

final readonly class Authentication
{
    public function __construct(
        private JWTAuth $guard,
        private Hasher $hasher,
        private DatabaseManager $database,
    ) {}

    public function login(LoginPayload $payload): string
    {
        return $this->guard->attempt(
            credentials: $payload->toArray(),
        );
    }

    /** @throws ValidationException|Throwable */
    public function register(RegisterPayload $payload): string
    {
        $user = $this->database->transaction(
            callback: fn() => User::query()->create(
                attributes: array_merge(
                    $payload->toArray(),
                    ['password' => $this->hasher->make(
                        value: $payload->password,
                    )],
                ),
            ),
            attempts: 3,
        );

        return $this->guard->attempt(
            credentials: [
                'email' => $payload->email,
                'password' => $payload->password,
            ],
        );
    }
}
