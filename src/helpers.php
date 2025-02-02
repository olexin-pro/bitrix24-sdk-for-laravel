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
