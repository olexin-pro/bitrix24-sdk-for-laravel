<?php

namespace OlexinPro\Bitrix24\API\Batch;

trait BatchableTrait
{
    protected array $params = [];
    protected string $method = '';

    public function setParams(array $params): self
    {
        $this->params = $params;
        return $this;
    }

    public function setMethod(string $method): self
    {
        $this->method = $method;
        return $this;
    }

    public function toBatchRequest(): array
    {
        return [
            'method' => $this->method,
            'params' => $this->params
        ];
    }
}
