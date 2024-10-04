<?php

declare(strict_types=1);

namespace App\Http\Responses\V1;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

use function config;

final readonly class TokenResponse implements Responsable
{
    public function __construct(
        private string $token,
        private int $status = Response::HTTP_OK,
    ) {}

    public function toResponse($request): Response
    {
        return new JsonResponse(
            data: [
                'token' => $this->token,
                'type' => 'Bearer',
                'expires' => config('jwt.ttl', 3600),
            ],
            status: $this->status,
        );
    }
}
