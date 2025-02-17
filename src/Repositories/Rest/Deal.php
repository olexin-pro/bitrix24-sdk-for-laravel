<?php

declare(strict_types=1);

namespace OlexinPro\Bitrix24\Repositories\Rest;

use OlexinPro\Bitrix24\API\Batch\Requests\BatchDealRequest;
use OlexinPro\Bitrix24\Contracts\Rest\DealInterface;
use OlexinPro\Bitrix24\Entities\DTO\AbstractBitrix24DTO;
use OlexinPro\Bitrix24\Entities\DTO\Rest\DealEntity;
use OlexinPro\Bitrix24\Enums\Rest\DealApiMethod;

class Deal extends BaseRest implements DealInterface
{
    public function __construct()
    {
        $this->defaultEntityClass = config('bitrix24.default_entity_class.deal', DealEntity::class);
    }

    public function add(array $fields): array
    {
        return $this->request(DealApiMethod::ADD->value, [
            'fields' => $fields,
        ]);
    }

    public function update(int $id, array $fields): array
    {
        return $this->request(DealApiMethod::UPDATE->value, [
            'id' => $id,
            'fields' => $fields,
        ]);
    }

    public function get(int $id): array
    {
        return $this->request(DealApiMethod::GET->value, [
            'id' => $id
        ]);
    }

    /**
     */
    public function getWithProducts(int $id): array
    {
        $data = $this->batch([
            'deal_data' => (new BatchDealRequest())->get($id),
            AbstractBitrix24DTO::PRODUCT_ROWS_KEY => (new BatchDealRequest())->productRowsGet($id)
        ]);

        $lead = $data['result']['deal_data'];
        $lead[AbstractBitrix24DTO::PRODUCT_ROWS_KEY] = $data['result'][AbstractBitrix24DTO::PRODUCT_ROWS_KEY];

        unset($data);
        return $lead;
    }

    /**
     * @return array<int, array>
     */
    public function list(?array $select = [], ?array $filter = [], ?array $order = [], ?int $start = 0): array
    {
        return $this->request(DealApiMethod::LIST->value, [
            'select' => $select,
            'filter' => $filter,
            'order' => $order,
            'start' => $start
        ]);
    }

    public function delete(int $id): array
    {
        return $this->request(DealApiMethod::DELETE->value, [
            'id' => $id,
        ]);
    }

    public function fields(): array
    {
        return $this->request(DealApiMethod::FIELDS->value);
    }

    public function productRowsSet(int $id, array $products): array
    {
        return $this->request(DealApiMethod::PRODUCT_ROWS_SET->value, [
            'id' => $id,
            'products' => $products,
        ]);
    }

    public function productRowsGet(int $id): array
    {
        return $this->request(DealApiMethod::PRODUCT_ROWS_GET->value, [
            'id' => $id,
        ]);
    }
}
