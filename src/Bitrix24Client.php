<?php

declare(strict_types=1);

namespace OlexinPro\Bitrix24;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\Client\PendingRequest;
use OlexinPro\Bitrix24\API\Client;
use OlexinPro\Bitrix24\Exceptions\OAuthAuthorizationRequiredException;
use OlexinPro\Bitrix24\Services\Bitrix24OAuthService;
use Throwable;

class Bitrix24Client extends Client
{
    protected function baseUrl(): string
    {
        return sprintf('%s/rest/', bitrix24Domain());
    }

    /**
     * @throws Throwable
     * @throws BindingResolutionException
     */
    protected function authorize(PendingRequest $request): PendingRequest
    {
        $bitrixOAuthService = app()->make(Bitrix24OAuthService::class);

        if ($bitrixOAuthService->needAuthorize()) {
            throw new OAuthAuthorizationRequiredException();
        }

        $authToken = $bitrixOAuthService->getValidToken();

        return $request->withOptions([
            'query' => ['auth' => $authToken]
        ]);
    }

    public function getHttp(): PendingRequest
    {
        return $this->getBaseRequest();
    }
}
