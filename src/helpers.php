<?php

if (!function_exists('bitrix24Domain')) {
    function bitrix24Domain(): string
    {
        $domain = config('bitrix24.domain');

        if (!preg_match('/^https?:\/\//', $domain)) {
            $domain = 'https://' . $domain;
        }

        return rtrim($domain, '/');
    }
}

if (!function_exists('json_validate')) {
    function json_validate(string $value): bool
    {
        json_decode($value);
        return json_last_error() === JSON_ERROR_NONE;
    }
}
