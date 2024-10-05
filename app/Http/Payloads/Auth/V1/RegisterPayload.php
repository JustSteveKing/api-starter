<?php

declare(strict_types=1);

namespace App\Http\Payloads\Auth\V1;

final readonly class RegisterPayload
{
    public function __construct(
        public string $name,
        public string $email,
        public string $password,
    ) {}

    public static function make(string $name, string $email, string $password): RegisterPayload
    {
        return new RegisterPayload(
            name: $name,
            email: $email,
            password: $password,
        );
    }

    /** @return array{name:string,email:string,password:string} */
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
        ];
    }
}
