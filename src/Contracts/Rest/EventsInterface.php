<?php

declare(strict_types=1);

namespace OlexinPro\Bitrix24\Contracts\Rest;

interface EventsInterface
{
    public function get();

    public function all(
        array $scopes = [],
        bool $full = false
    );

    public function bind(array $params);

    public function unbind(array $params);

    public function offlineGet(
        array $filter = [],
        array $order = [],
        int $limit = 50,
        bool $clear = false,
        bool $withErrors = false,
        ?string $processId = null
    );

    public function offlineList(
        array $filter = [],
        array $order = [],
        int $start = 0
    );

    public function offlineClear(
        string $processId,
        array $ids = [],
        array $messageIds = []
    );

    public function offlineListAsCollection(array $filter = [], array $order = [], int $start = 0);

    public function offlineGetAsCollection(
        array $filter = [],
        array $order = [],
        int $limit = 50,
        bool $clear = false,
        bool $withErrors = false,
        ?string $processId = null
    );
}
