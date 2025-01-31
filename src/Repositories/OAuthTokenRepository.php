<?php

declare(strict_types=1);

namespace OlexinPro\Bitrix24\Repository;

use Illuminate\Support\Facades\Cache;
use OlexinPro\Bitrix24\Contracts\TokenStorage;

class OAuthTokenRepository implements TokenStorage
{
    private const CACHE_KEY = 'bitrix24_oauth_token';

    /**
     * Получить токен из хранилища
     *
     * @return array|null
     */
    public function getToken(): ?array
    {
        return Cache::get(self::CACHE_KEY);
    }

    /**
     * Удалить токен из хранилища
     *
     * @return bool
     */
    public function clearToken(): bool
    {
        return Cache::delete(self::CACHE_KEY);
    }

    /**
     * Сохранить токен в хранилище
     *
     * @param string $accessToken
     * @param string $refreshToken
     * @param int $expiresIn
     * @return void
     */
    public function saveToken(string $accessToken, string $refreshToken, int $expiresIn): void
    {
        $expiresAt = now()->addSeconds($expiresIn);

        Cache::forever(self::CACHE_KEY, [
            'access_token' => $accessToken,
            'refresh_token' => $refreshToken,
            'expires_at' => $expiresAt
        ]);
    }

}
