<?php

declare(strict_types=1);

namespace OlexinPro\Bitrix24\API\Batch;

use Illuminate\Http\Client\Response;
use OlexinPro\Bitrix24\API\ApiRequest;
use OlexinPro\Bitrix24\API\HttpMethod;
use OlexinPro\Bitrix24\Bitrix24Client;
use OlexinPro\Bitrix24\Contracts\Batch\BatchableInterface;
use OlexinPro\Bitrix24\Contracts\Batch\BatchCommandCollectionInterface;

class Batch
{
    private BatchCommandCollectionInterface $commandCollection;
    private Bitrix24Client $client;

    public function __construct(
        Bitrix24Client $client,
        ?BatchCommandCollectionInterface $commandCollection = null
    ) {
        $this->client = $client;
        $this->commandCollection = $commandCollection ?? new BatchCommandCollection();
    }

    public function add(string $id, string|BatchableInterface $request): self
    {
        $this->commandCollection->add($id, $request);
        return $this;
    }

    public function halt(bool $halt = true): self
    {
        $this->commandCollection->setHalt($halt);
        return $this;
    }

    public function execute(): Response
    {
        $request = new ApiRequest(HttpMethod::POST, 'batch');
        $request->setBody([
            'halt' => $this->commandCollection->isHalt(),
            'cmd' => $this->commandCollection->getCommands()
        ]);

        return $this->client->send($request);
    }
}
