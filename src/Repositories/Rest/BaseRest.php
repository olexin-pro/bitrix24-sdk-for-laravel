<?php

declare(strict_types=1);

namespace OlexinPro\Bitrix24\Repositories\Rest;

use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;
use OlexinPro\Bitrix24\API\ApiRequest;
use OlexinPro\Bitrix24\API\Batch\Batch;
use OlexinPro\Bitrix24\Bitrix24Client;
use OlexinPro\Bitrix24\Contracts\AsCollectionEntityInterface;

abstract class BaseRest implements AsCollectionEntityInterface
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
     */
    public function batch(array $requests): array
    {
        $response = $this->sendBatch($requests);
        return $response['result'];
    }

    /**
     * @throws BindingResolutionException
     * @throws Exception
     */
    protected function send(ApiRequest $request)
    {
        $client = $this->getClient();
        $resp = $client->send($request);
        $data = $resp->json();
        if ($resp->failed() || array_key_exists('error', $data)) {
            throw new Exception($data['error']);
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


    /**
     * @throws BindingResolutionException
     * @throws Exception
     */
    protected function sendBatch(array $requests)
    {
        $client = $this->getBatch();
        foreach ($requests as $id => $request){
            $client->add($id, $request);
        }
        $resp = $client->execute();
        $data = $resp->json();
        if ($resp->failed() || array_key_exists('error', $data)) {
            throw new Exception($data['error']);
        }
        return $data;
    }
    /**
     * @throws BindingResolutionException
     */
    private function getBatch(): Batch
    {
        return app()->make(Batch::class);
    }
}
