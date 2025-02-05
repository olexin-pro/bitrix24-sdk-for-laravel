<?php

declare(strict_types=1);

namespace OlexinPro\Bitrix24\Services;

use DateTimeInterface;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use OlexinPro\Bitrix24\Contracts\TokenStorageInterface;
use OlexinPro\Bitrix24\Exceptions\MissingAuthCodeException;
use OlexinPro\Bitrix24\Exceptions\TokenRefreshException;


class Bitrix24OAuthService
{
    private string $clientId;
    private string $clientSecret;
    private string $tokenUrl;
    private string $authConnector;
    private TokenStorageInterface $tokenRepository;

    public function __construct(TokenStorageInterface $tokenRepository)
    {
        $this->clientId = config('bitrix24.client_id');
        $this->clientSecret = config('bitrix24.client_secret');
        $this->tokenUrl = config('bitrix24.oauth_uri');
        $this->authConnector = config('bitrix24.auth_connector');
        $this->tokenRepository = $tokenRepository;
    }

    /**
     * Получить валидный токен для работы с API
     *
     * @return string
     * @throws TokenRefreshException
     */
    public function getValidToken(): string
    {
        $token = $this->tokenRepository->getToken();

        if (!$token || $this->isTokenExpired($token['expires_at'])) {
            $token = $this->getToken($token['refresh_token'] ?? null);
        }

        return $token['access_token'];
    }

    /**
     * Обновить токен
     *
     * @param string|null $refreshToken
     * @return array
     * @throws TokenRefreshException
     */
    private function getToken(?string $refreshToken): array
    {
        if (blank($refreshToken)) {
            throw new TokenRefreshException('Failed to refresh token, need authorize');
        }

        return $this->refreshToken($refreshToken);
    }

    /**
     * @throws TokenRefreshException
     * @throws ConnectionException
     */
    private function refreshToken(string $refreshToken)
    {
        $params = [
            'grant_type' => 'refresh_token',
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
            'refresh_token' => $refreshToken
        ];

        $response = Http::acceptJson()->get($this->tokenUrl, $params);

        $data = $response->json();

        if ($response->failed() || array_key_exists('error', $data)) {
            throw new TokenRefreshException("Failed to refresh token: {$data['error']}");
        }

        $this->tokenRepository->saveToken(
            $data['access_token'],
            $data['refresh_token'],
            intval($data['expires_in'])
        );

        return $data;
    }

    /**
     * Проверить, истёк ли токен
     *
     * @param DateTimeInterface $expiresAt
     * @return bool
     */
    private function isTokenExpired(DateTimeInterface $expiresAt): bool
    {
        return now()->greaterThanOrEqualTo($expiresAt);
    }

    /**
     * Проверить, нужна установка токена
     *
     * @return bool
     */
    public function needAuthorize(): bool
    {
        $token = $this->tokenRepository->getToken();
        return blank($token);
    }

    /**
     * @throws MissingAuthCodeException
     */
    public function installToken(Request $request): string
    {
        if (!$request->has('code')) {
            dd($request->all());
            throw new MissingAuthCodeException();
        }

        return $this->authorizationCode($request->get('code'));
    }

    /**
     * @throws Exception
     */
    private function authorizationCode(string $authCode)
    {
        $params = [
            'grant_type' => 'authorization_code',
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
            'code' => $authCode,
        ];

        $response = Http::acceptJson()->get($this->tokenUrl, $params);
        $data = $response->json();

        if ($response->failed() || array_key_exists('error', $data)) {
            throw new TokenRefreshException("Failed to refresh token: {$data['error']}: {$data['error_description']}");
        }

        $this->tokenRepository->saveToken(
            $data['access_token'],
            $data['refresh_token'],
            intval($data['expires_in'])
        );

        return $data['access_token'];
    }

    /**
     */
    public function authorizeRedirect(): RedirectResponse
    {
        return response()->redirectTo($this->getOAuthUrl());
    }

    public function getOAuthUrl(): string
    {
        $domain = \bitrix24Domain();

        $params = [
            'client_id' => $this->clientId,
            'state' => $this->authConnector,
            'redirect_uri' => url('/test/token')
        ];

        return sprintf('%s%s?%s', $domain, '/oauth/authorize/', http_build_query($params));
    }

}
