<?php

use Illuminate\Support\Facades\Route;
use OlexinPro\Bitrix24\Controllers\OAuthController;


Route::any(
    config('bitrix24.routes.oauth_redirect_to_bitrix24', 'oauth/authorize'),
    [OauthController::class, 'authorize']
)
    ->name('bitrix24.oauth.authorize');
Route::any(
    config('bitrix24.routes.oauth_install_token', 'oauth/install'),
    [OauthController::class, 'install']
)
    ->name('bitrix24.oauth.install');
