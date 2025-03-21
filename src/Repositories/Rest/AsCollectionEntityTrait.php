<?php

namespace OlexinPro\Bitrix24\Repositories\Rest;

use Generator;
use Illuminate\Support\Collection;
use OlexinPro\Bitrix24\Entities\DTO\Bitrix24DTOInterface;
use OlexinPro\Bitrix24\Entities\DTO\Bitrix24FieldDescriptionDTO;

/**
 * @requires method list
 * @requires method get
 * @requires method getWithProducts
 * @requires method fields
 */
trait AsCollectionEntityTrait
{
    protected ?string $defaultEntityClass = null;


    /**
     * @return Collection<Bitrix24DTOInterface|array>
     */
    public function listAsEntity(): Generator
    {
        $method = 'list';
        $this->ensureMethodExists($method);

        $generator = $this->{$method}(...func_get_args());

        foreach ($generator as $item) {
            yield $this->convertToEntity($item);
        }
    }


    /**
     * @return Generator<Bitrix24DTOInterface|array>
     */
    public function listEagerAsEntity(): Generator
    {
        $method = 'listEager';
        $this->ensureMethodExists($method);

        $generator = $this->{$method}(...func_get_args());

        foreach ($generator as $item) {
            yield $this->convertToEntity($item);
        }
    }


    /**
     * @return Bitrix24DTOInterface|array
     */
    public function getAsEntity(): Bitrix24DTOInterface|array
    {
        $method = 'get';
        $this->ensureMethodExists($method);

        $data = $this->{$method}(...func_get_args());

        return $this->convertToEntity($data);
    }

    /**
     * @return Bitrix24DTOInterface|array
     */
    public function getAsEntityWithProducts(): Bitrix24DTOInterface|array
    {
        $method = 'getWithProducts';
        $this->ensureMethodExists($method);

        $data = $this->{$method}(...func_get_args());

        return $this->convertToEntity($data);
    }


    /**
     * @return Collection<Bitrix24FieldDescriptionDTO>
     */
    public function fieldsCollection(): Collection
    {
        $method = 'fields';
        $this->ensureMethodExists($method);

        return collect($this->{$method}())->mapWithKeys(function (array $item, string $key){
            return [$key => Bitrix24FieldDescriptionDTO::fromArray($key, $item)];
        })->values();
    }

    /**
     * @param string $method
     * @return void
     */
    private function ensureMethodExists(string $method): void
    {
        if (!method_exists($this, $method)) {
            throw new \BadMethodCallException("Method {$method}() does not exist.");
        }
    }

    /**
     * @param array $data
     * @return Bitrix24DTOInterface|array
     */
    private function convertToEntity(array $data): Bitrix24DTOInterface|array
    {
        if (!is_subclass_of($this->defaultEntityClass, Bitrix24DTOInterface::class)) {
            return $data;
        }


        return new $this->defaultEntityClass($data);
    }
}
