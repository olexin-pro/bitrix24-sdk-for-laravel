<?php

declare(strict_types=1);

namespace OlexinPro\Bitrix24\API\Batch;

use OlexinPro\Bitrix24\Contracts\Batch\BatchableInterface;
use OlexinPro\Bitrix24\Contracts\Batch\BatchCommandCollectionInterface;

class BatchCommandCollection implements BatchCommandCollectionInterface
{
    private array $commands = [];
    private bool $halt = false;

    public function add(string $id, string|BatchableInterface $request): self
    {
        if ($request instanceof BatchableInterface) {
            $batchRequest = $request->toBatchRequest();
            $method = $batchRequest['method'];
            if (!empty($batchRequest['params'])) {
                $method .= '?' . http_build_query($batchRequest['params']);
            }
        } else {
            $method = $request;
        }

        $this->commands[$id] = $method;
        return $this;
    }

    public function getCommands(): array
    {
        return $this->commands;
    }

    public function isHalt(): bool
    {
        return $this->halt;
    }

    public function setHalt(bool $halt): self
    {
        $this->halt = $halt;
        return $this;
    }
}
