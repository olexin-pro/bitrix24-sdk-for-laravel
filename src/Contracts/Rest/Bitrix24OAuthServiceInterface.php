<?php

declare(strict_types=1);

namespace OlexinPro\Bitrix24\Contracts\Rest;

use DateTimeInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

interface Bitrix24OAuthServiceInterface
{
    public function getValidToken(): string;

    public function isTokenExpired(DateTimeInterface $expiresAt): bool;

    public function needAuthorize(): bool;

    public function installToken(Request $request): string;

    public function authorizeRedirect(): RedirectResponse;

    public function getOAuthUrl(): string;
}
