<?php

declare(strict_types=1);

namespace OlexinPro\Bitrix24\Contracts;

interface TokenStorage
{
    public function getToken(): ?array;

    public function clearToken(): bool;

    public function saveToken(string $accessToken, string $refreshToken, int $expiresIn): void;

}
