<?php

declare(strict_types=1);

namespace OlexinPro\Bitrix24\Repository\Rest;

use Illuminate\Http\Client\Response;
use OlexinPro\Bitrix24\Contracts\Rest\NotificationInterface;

class Notify extends BaseRest implements NotificationInterface
{
    public function personalAdd(
        int $userId,
        string $message,
        ?string $messageOut = null,
        ?string $tag = null,
        ?string $subTag = null,
        ?array $attachment = null
    ): Response {
        return $this->request('im.notify.personal.add', [
            'USER_ID' => $userId,
            'MESSAGE' => $message,
            'MESSAGE_OUT' => $messageOut ?? $message,
            'TAG' => $tag,
            'SUB_TAG' => $subTag,
            'ATTACH' => $attachment,
        ]);
    }

    public function systemAdd(
        int $userId,
        string $message,
        ?string $messageOut = null,
        ?string $tag = null,
        ?string $subTag = null,
        ?array $attachment = null
    ): Response {
        return $this->request('im.notify.personal.add', [
            'USER_ID' => $userId,
            'MESSAGE' => $message,
            'MESSAGE_OUT' => $messageOut ?? $message,
            'TAG' => $tag,
            'SUB_TAG' => $subTag,
            'ATTACH' => $attachment,
        ]);
    }

    public function delete(int $id, ?string $tag = null, ?string $subTag = null): Response
    {
        return $this->request('im.notify.delete', [
            'ID' => $id,
            'TAG' => $tag,
            'SUB_TAG' => $subTag,
        ]);
    }

    public function read(int $id, ?bool $onlyCurrent = false): Response
    {
        return $this->request('im.notify.read', [
            'ID' => $id,
            'ONLY_CURRENT' => $onlyCurrent ? 'Y' : 'N',
        ]);
    }

    public function readList(array $ids, ?bool $action): Response
    {
        return $this->request('im.notify.read.list', [
            'IDs' => $ids,
            'ACTION' => $action ? 'Y' : 'N',
        ]);
    }

}
