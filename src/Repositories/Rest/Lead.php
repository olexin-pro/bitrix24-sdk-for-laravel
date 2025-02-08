<?php

declare(strict_types=1);

namespace OlexinPro\Bitrix24\Repositories\Rest;

use Illuminate\Support\Collection;
use OlexinPro\Bitrix24\Contracts\Rest\LeadInterface;
use OlexinPro\Bitrix24\Entities\DTO\Rest\LeadEntity;
use OlexinPro\Bitrix24\Enums\Rest\LeadApiMethod;

class Lead extends BaseRest implements LeadInterface
{

    public function add(array $fields)
    {
        // TODO: Implement add() method.
    }

    public function update(int $id, array $fields)
    {
        // TODO: Implement update() method.
    }

    public function get(int $id)
    {
        // TODO: Implement get() method.
    }

    /**
     * @return Collection<LeadEntity>
     */
    public function list(?array $select = [], ?array $filter = [], ?array $order = [], ?int $start = 0): Collection
    {
        $data = $this->request(LeadApiMethod::LIST->value, [
            'select' => $select,
            'filter' => $filter,
            'order' => $order,
            'start' => $start
        ]);

        return collect($data)->map(function ($item) {
            return new LeadEntity($item);
        });
    }

    public function delete(int $id)
    {
        // TODO: Implement delete() method.
    }

    public function fields()
    {
        // TODO: Implement fields() method.
    }
}
