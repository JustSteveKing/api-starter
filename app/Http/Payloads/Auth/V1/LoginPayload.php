<?php

declare(strict_types=1);

namespace App\Http\Payloads\Auth\V1;

final readonly class LoginPayload
{
    public function __construct(
        public string $email,
        public string $password,
    ) {}

    /** @return array{email:string,password:string} */
    public function toArray(): array
    {
        return [
            'email' => $this->email,
            'password' => $this->password,
        ];
    }

    public static function make(string $email, string $password): LoginPayload
    {
        return new LoginPayload(
            email: $email,
            password: $password,
        );
    }
}
