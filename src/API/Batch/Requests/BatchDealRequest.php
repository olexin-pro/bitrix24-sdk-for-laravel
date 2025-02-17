<?php

declare(strict_types=1);

namespace OlexinPro\Bitrix24\API\Batch\Requests;

use OlexinPro\Bitrix24\API\Batch\BatchableTrait;
use OlexinPro\Bitrix24\Contracts\Batch\BatchableInterface;
use OlexinPro\Bitrix24\Contracts\Rest\LeadInterface;
use OlexinPro\Bitrix24\Contracts\Rest\ProductRowsInterface;
use OlexinPro\Bitrix24\Contracts\Rest\StandardBitrixMethodsInterface;
use OlexinPro\Bitrix24\Contracts\Rest\UserInterface;
use OlexinPro\Bitrix24\Enums\Rest\DealApiMethod;
use OlexinPro\Bitrix24\Enums\Rest\LeadApiMethod;
use OlexinPro\Bitrix24\Enums\Rest\UserApiMethod;

class BatchDealRequest implements StandardBitrixMethodsInterface, ProductRowsInterface, BatchableInterface
{
    use BatchableTrait;

    public function add(array $fields): BatchDealRequest
    {
        return $this
            ->setMethod(DealApiMethod::ADD->value)
            ->setParams(['fields' => $fields]);
    }

    public function update(int $id, array $fields): BatchDealRequest
    {
        return $this
            ->setMethod(DealApiMethod::UPDATE->value)
            ->setParams(['id' => $id, 'fields' => $fields]);
    }

    public function get(int $id): BatchDealRequest
    {
        return $this
            ->setMethod(DealApiMethod::GET->value)
            ->setParams(['id' => $id]);
    }

    public function list(?array $select = [], ?array $filter = [], ?array $order = [], ?int $start = 0): BatchDealRequest
    {
        return $this
            ->setMethod(DealApiMethod::GET->value)
            ->setParams([
                'select' => $select,
                'filter' => $filter,
                'order' => $order,
                'start' => $start
            ]);
    }

    public function delete(int $id): BatchDealRequest
    {
        return $this
            ->setMethod(DealApiMethod::DELETE->value)
            ->setParams(['id' => $id]);
    }

    public function fields(): BatchDealRequest
    {
        return $this
            ->setMethod(DealApiMethod::DELETE->value)
            ->setParams([]);
    }

    public function productRowsSet(int $id, array $products): BatchDealRequest
    {
        return $this
            ->setMethod(DealApiMethod::UPDATE->value)
            ->setParams(['id' => $id, 'products' => $products]);
    }

    public function productRowsGet(int $id): BatchDealRequest
    {
        return $this
            ->setMethod(DealApiMethod::PRODUCT_ROWS_GET->value)
            ->setParams(['id' => $id]);
    }
}
