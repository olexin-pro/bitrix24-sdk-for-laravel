<?php

declare(strict_types=1);

namespace OlexinPro\Bitrix24\Repository\Rest;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\Client\Response;
use OlexinPro\Bitrix24\API\ApiRequest;
use OlexinPro\Bitrix24\Bitrix24Client;

abstract class BaseRest
{
    public function request(string $method, array $params): Response
    {
        $request = ApiRequest::post($method)
            ->setBody($params);

        return $this->send($request);
    }

    protected function send(ApiRequest $request)
    {
        $client = $this->getClient();
        return $client->send($request);
    }

    /**
     * @throws BindingResolutionException
     */
    private function getClient(): Bitrix24Client
    {
        return app()->make(Bitrix24Client::class);
    }
}
