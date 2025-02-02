<?php

declare(strict_types=1);

namespace OlexinPro\Bitrix24\Controllers;

use Illuminate\Http\Request;
use OlexinPro\Bitrix24\Services\Bitrix24OAuthService;

class OAuthController
{
    public function authorize(Request $request)
    {
        $bitrixOAuthService = app()->make(Bitrix24OAuthService::class);
        return $bitrixOAuthService->authorizeRedirect();
    }

    public function install(Request $request)
    {
        $bitrixOAuthService = app()->make(Bitrix24OAuthService::class);
        $bitrixOAuthService->installToken($request);
        return redirect()->to('/');
    }
}
