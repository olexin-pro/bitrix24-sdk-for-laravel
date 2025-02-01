<?php

namespace OlexinPro\Bitrix24\Contracts\Batch;

interface BatchCommandCollectionInterface
{
    public function add(string $id, string|BatchableInterface $request): self;

    public function getCommands(): array;

    public function setHalt(bool $halt): self;

    public function isHalt(): bool;
}
