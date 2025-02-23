<?php

declare(strict_types=1);

namespace OlexinPro\Bitrix24\Repositories\Rest;

use Exception;
use Generator;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\Client\Response;
use OlexinPro\Bitrix24\API\ApiRequest;
use OlexinPro\Bitrix24\API\Batch\Batch;
use OlexinPro\Bitrix24\Bitrix24Client;
use OlexinPro\Bitrix24\Contracts\AsCollectionEntityInterface;
use OlexinPro\Bitrix24\Exceptions\Bitrix24APIException;

abstract class BaseRest implements AsCollectionEntityInterface
{
    use AsCollectionEntityTrait;

    protected Response $lastResponse;


    public function getLastResponse(): Response
    {
        return $this->lastResponse;
    }

    /**
     * @throws BindingResolutionException
     * @throws Bitrix24APIException
     */
    public function request(string $method, array $params = []): array
    {
        $request = ApiRequest::post($method)
            ->setBody($params);

        $this->lastResponse = $this->send($request);
        $data = $this->lastResponse->json();


        if ($this->lastResponse->failed() || array_key_exists('error', $data)) {
            $jsonResponse = json_encode($data);
            $jsonParams = json_encode($params);

            throw new Bitrix24APIException("Ошибка при запросе '{$method}' ({$jsonParams}): {$jsonResponse}");
        }

        return $this->lastResponse['result'];
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
        return $client->send($request);
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
        foreach ($requests as $id => $request) {
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

    /**
     * @throws BindingResolutionException
     * @throws Bitrix24APIException
     */
    public function fetchList(string $method, array $params = [], string $idField = 'ID'): Generator
    {
        $params['order'][$idField] = 'ASC';
        $params['filter'][">$idField"] = 0;
        $params['start'] = -1;

        $totalCounter = 0;

        do {
            $result = $this->request($method, $params);

            $resultCounter = count($result);
            $totalCounter += $resultCounter;

            logger()->debug(
                "По запросу (fetchList) {$method} получено сущностей: {$resultCounter}, " .
                "всего получено: {$totalCounter}"
            );

            foreach ($result as $item) {
                yield $item;
            }

            if ($resultCounter < 50) {
                break;
            }

            $params['filter'][">$idField"] = $result[$resultCounter - 1][$idField];
        } while (true);
    }

    /**
     * @throws BindingResolutionException
     * @throws Bitrix24APIException
     */
    public function getList(string $method, array $params = []): Generator
    {
        do {
            $result = $this->request($method, $params);
            $start = $params['start'] ?? 0;

            $lastResponse = $this->lastResponse->json();

            logger()->debug(
                "По запросу (getList) {$method} (start: {$start}) получено сущностей: "
                . count($result)
                . ", всего получено: {$lastResponse['total']}"
            );

            foreach ($result as $item) {
                yield $item;
            }

            if (empty($lastResponse['next'])) {
                break;
            }
            $params['start'] = $lastResponse['next'];
        } while (true);
    }

}
