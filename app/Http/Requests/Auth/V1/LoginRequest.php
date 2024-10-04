<?php

declare(strict_types=1);

namespace App\Http\Requests\Auth\V1;

use App\Http\Payloads\Auth\V1\LoginPayload;
use App\Http\Requests\Concerns\RateLimited;
use Illuminate\Foundation\Http\FormRequest;

final class LoginRequest extends FormRequest
{
    use RateLimited;

    /** @return array<string,array<int,string>> */
    public function rules(): array
    {
        return [
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ];
    }

    public function payload(): LoginPayload
    {
        return LoginPayload::make(
            email: $this->string('email')->toString(),
            password: $this->string('password')->toString(),
        );
    }

    /** @return array<string,array<string,string>> */
    public function bodyParameters(): array
    {
        return [
            'email' => [
                'description' => 'The email of the authenticating user.',
                'example' => 'jon.snow@thewall.io',
            ],
            'password' => [
                'description' => 'The password of the authenticating user.',
                'example' => 'super-secret-password',
            ],
        ];
    }
}
