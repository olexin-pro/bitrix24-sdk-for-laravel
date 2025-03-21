<?php

declare(strict_types=1);

namespace OlexinPro\Bitrix24\Repositories\Rest;

use Generator;
use Illuminate\Contracts\Container\BindingResolutionException;
use OlexinPro\Bitrix24\API\Batch\Requests\BatchLeadRequest;
use OlexinPro\Bitrix24\Contracts\Rest\LeadInterface;
use OlexinPro\Bitrix24\Entities\DTO\AbstractBitrix24DTO;
use OlexinPro\Bitrix24\Entities\DTO\Rest\LeadEntity;
use OlexinPro\Bitrix24\Enums\Rest\LeadApiMethod;
use OlexinPro\Bitrix24\Exceptions\Bitrix24APIException;

class Lead extends BaseRest implements LeadInterface
{
    public function __construct()
    {
        $this->defaultEntityClass = config('bitrix24.default_entity_class.lead', LeadEntity::class);
    }

    public function add(array $fields): array
    {
        return $this->request(LeadApiMethod::ADD->value, [
            'fields' => $fields,
        ]);
    }

    public function update(int $id, array $fields): array
    {
        return $this->request(LeadApiMethod::UPDATE->value, [
            'id' => $id,
            'fields' => $fields,
        ]);
    }

    /**
     * @throws BindingResolutionException
     * @throws Bitrix24APIException
     */
    public function get(int $id): array
    {
        return $this->request(LeadApiMethod::GET->value, [
            'id' => $id
        ]);
    }

    /**
     */
    public function getWithProducts(int $id): array
    {
        $data = $this->batch([
            'lead_data' => (new BatchLeadRequest())->get($id),
            AbstractBitrix24DTO::PRODUCT_ROWS_KEY => (new BatchLeadRequest())->productRowsGet($id)
        ]);

        $lead = $data['result']['lead_data'];
        $lead[AbstractBitrix24DTO::PRODUCT_ROWS_KEY] = $data['result'][AbstractBitrix24DTO::PRODUCT_ROWS_KEY];

        unset($data);
        return $lead;
    }

    /**
     * @param array|null $select
     * @param array|null $filter
     * @param array|null $order
     * @return Generator<array>
     * @throws BindingResolutionException
     * @throws Bitrix24APIException
     */
    public function list(?array $select = [], ?array $filter = [], ?array $order = []): Generator
    {
        return $this->getList(LeadApiMethod::LIST->value, [
            'select' => $select,
            'filter' => $filter,
            'order' => $order,
        ]);
    }

    /**
     * @param array|null $select
     * @param array|null $filter
     * @param array|null $order
     * @return Generator
     * @throws BindingResolutionException
     * @throws Bitrix24APIException
     */
    public function listEager(?array $select = [], ?array $filter = [], ?array $order = []): Generator
    {
        return $this->fetchList(LeadApiMethod::LIST->value, [
            'select' => $select,
            'filter' => $filter,
            'order' => $order
        ]);
    }

    public function delete(int $id): array
    {
        return $this->request(LeadApiMethod::DELETE->value, [
            'id' => $id,
        ]);
    }

    public function fields(): array
    {
        return $this->request(LeadApiMethod::FIELDS->value);
    }

    public function productRowsSet(int $id, array $products): array
    {
        return $this->request(LeadApiMethod::PRODUCT_ROWS_SET->value, [
            'id' => $id,
            'products' => $products,
        ]);
    }

    public function productRowsGet(int $id): array
    {
        return $this->request(LeadApiMethod::PRODUCT_ROWS_GET->value, [
            'id' => $id,
        ]);
    }
}
