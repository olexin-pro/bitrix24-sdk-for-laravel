<?php

declare(strict_types=1);

namespace OlexinPro\Bitrix24\API\Batch\Requests;

use OlexinPro\Bitrix24\API\Batch\BatchableTrait;
use OlexinPro\Bitrix24\Contracts\Batch\BatchableInterface;
use OlexinPro\Bitrix24\Contracts\Rest\ProductRowsInterface;
use OlexinPro\Bitrix24\Contracts\Rest\StandardBitrixMethodsInterface;
use OlexinPro\Bitrix24\Enums\Rest\OfferApiMethod;

class BatchOfferRequest implements StandardBitrixMethodsInterface, ProductRowsInterface, BatchableInterface
{
    use BatchableTrait;

    public function add(array $fields): static
    {
        return $this
            ->setMethod(OfferApiMethod::ADD->value)
            ->setParams(['fields' => $fields]);
    }

    public function update(int $id, array $fields): static
    {
        return $this
            ->setMethod(OfferApiMethod::UPDATE->value)
            ->setParams(['id' => $id, 'fields' => $fields]);
    }

    public function get(int $id): static
    {
        return $this
            ->setMethod(OfferApiMethod::GET->value)
            ->setParams(['id' => $id]);
    }

    public function list(?array $select = [], ?array $filter = [], ?array $order = [], ?int $start = 0): static
    {
        return $this
            ->setMethod(OfferApiMethod::GET->value)
            ->setParams([
                'select' => $select,
                'filter' => $filter,
                'order' => $order,
                'start' => $start
            ]);
    }

    public function delete(int $id): static
    {
        return $this
            ->setMethod(OfferApiMethod::DELETE->value)
            ->setParams(['id' => $id]);
    }

    public function fields(): static
    {
        return $this
            ->setMethod(OfferApiMethod::DELETE->value)
            ->setParams([]);
    }

    public function productRowsSet(int $id, array $products): static
    {
        return $this
            ->setMethod(OfferApiMethod::UPDATE->value)
            ->setParams(['id' => $id, 'products' => $products]);
    }

    public function productRowsGet(int $id): static
    {
        return $this
            ->setMethod(OfferApiMethod::PRODUCT_ROWS_GET->value)
            ->setParams(['id' => $id]);
    }
}
