<?php

declare(strict_types=1);

namespace OlexinPro\Bitrix24\Repositories\Rest;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\Collection;
use OlexinPro\Bitrix24\Contracts\Rest\EventsInterface;
use OlexinPro\Bitrix24\Entities\Bitrix24Event;
use OlexinPro\Bitrix24\Enums\Rest\EventApiMethod;
use OlexinPro\Bitrix24\Exceptions\Bitrix24APIException;

class Events extends BaseRest implements EventsInterface
{

    /**
     * @throws BindingResolutionException
     * @throws Bitrix24APIException
     */
    public function get()
    {
        return $this->request(EventApiMethod::GET->value);
    }

    public function all(array $scopes = [], bool $full = false): array
    {
        $params = ['FULL' => $full ? 'true' : 'false'];

        if (count($scopes) > 0) {
            $params['SCOPE'] = implode(',', $scopes);
        }

        return $this->request(EventApiMethod::EVENTS->value, $params);
    }

    public function bind(array $params): array
    {
        return $this->request(EventApiMethod::BIND->value, $params);
    }

    public function unbind(array $params): array
    {
        return $this->request(EventApiMethod::UNBIND->value, $params);
    }

    public function offlineClear(string $processId, array $ids = [], array $messageIds = [])
    {
        return $this->request(EventApiMethod::OFFLINE_LIST->value, [
            'process_id' => $processId,
            'id' => $ids,
            'message_id' => $messageIds,
        ]);
    }

    /**
     * @param array $filter
     * @param array $order
     * @param int $limit
     * @param bool $clear
     * @param bool $withErrors
     * @param string|null $processId
     * @return Collection<Bitrix24Event>
     */
    public function offlineGetAsCollection(
        array $filter = [],
        array $order = [],
        int $limit = 50,
        bool $clear = false,
        bool $withErrors = false,
        ?string $processId = null
    ): \Illuminate\Support\Collection {
        $resp = $this->offlineGet($filter, $order, $limit, $clear, $withErrors, $processId);
        return collect($resp['events'])->map(function ($eventData) {
            return new Bitrix24Event($eventData);
        });
    }

    public function offlineGet(
        array $filter = [],
        array $order = [],
        int $limit = 50,
        bool $clear = false,
        bool $withErrors = false,
        ?string $processId = null
    ): array {
        return $this->request(EventApiMethod::OFFLINE_GET->value, [
            'filter' => $filter,
            'order' => $order,
            'limit' => $limit,
            'clear' => $clear ? '1' : '0',
            'error' => $withErrors ? '1' : '0',
            'process_id' => $processId,
        ]);
    }

    /**
     * @param array $filter
     * @param array $order
     * @param int $start
     * @return Collection<Bitrix24Event>
     */
    public function offlineListAsCollection(
        array $filter = [],
        array $order = [],
        int $start = 0
    ): \Illuminate\Support\Collection {
        $resp = $this->offlineList($filter, $order, $start);
        return collect($resp)->map(function ($eventData) {
            return new Bitrix24Event($eventData);
        });
    }

    public function offlineList(array $filter = [], array $order = [], int $start = 0)
    {
        return $this->request(EventApiMethod::OFFLINE_LIST->value, [
            'filter' => $filter,
            'order' => $order,
            'start' => $start,
        ]);
    }


}
