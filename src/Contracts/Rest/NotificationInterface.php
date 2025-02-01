<?php

namespace OlexinPro\Bitrix24\Contracts\Rest;

use Illuminate\Http\Client\Response;

interface NotificationInterface
{
    public function personalAdd(
        int $userId,
        string $message,
        ?string $messageOut = null,
        ?string $tag = null,
        ?string $subTag = null,
        ?array $attachment = null
    ): Response;

    public function systemAdd(
        int $userId,
        string $message,
        ?string $messageOut = null,
        ?string $tag = null,
        ?string $subTag = null,
        ?array $attachment = null
    ): Response;

    public function delete(int $id, ?string $tag = null, ?string $subTag = null): Response;

    public function read(int $id, ?bool $onlyCurrent = false): Response;

    public function readList(array $ids, ?bool $action): Response;
}
