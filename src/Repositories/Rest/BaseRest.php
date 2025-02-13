<?php

declare(strict_types=1);

namespace OlexinPro\Bitrix24\Repositories\Rest;

use Illuminate\Contracts\Container\BindingResolutionException;
use OlexinPro\Bitrix24\API\ApiRequest;
use OlexinPro\Bitrix24\Bitrix24Client;
use OlexinPro\Bitrix24\Entities\DTO\AbstractBitrix24DTO;

abstract class BaseRest
{
    use AsCollectionEntityTrait;

    public function request(string $method, array $params = []): array
    {
        $request = ApiRequest::post($method)
            ->setBody($params);

        $response = $this->send($request);

        return $response['result'];
    }

    /**
     * @throws BindingResolutionException
     * @throws \Exception
     */
    protected function send(ApiRequest $request)
    {
        $client = $this->getClient();
        $resp = $client->send($request);
        $data = $resp->json();
        if ($resp->failed() || array_key_exists('error', $data)) {
            throw new \Exception($data['error']);
        }
        return $data;
    }

    /**
     * @throws BindingResolutionException
     */
    private function getClient(): Bitrix24Client
    {
        return app()->make(Bitrix24Client::class);
    }
}
