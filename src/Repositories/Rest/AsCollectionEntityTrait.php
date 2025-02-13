<?php

namespace OlexinPro\Bitrix24\Repositories\Rest;

use Illuminate\Support\Collection;
use OlexinPro\Bitrix24\Entities\DTO\Bitrix24DTOInterface;
use OlexinPro\Bitrix24\Entities\DTO\Rest\LeadEntity;

trait AsCollectionEntityTrait
{
    protected ?string $defaultEntityClass = null;


    /**
     * @return Collection<Bitrix24DTOInterface|array>
     */
    public function listAsCollection(): Collection
    {
        if (!method_exists($this, 'list')){
            throw new \BadMethodCallException('Method list() does not exist.');
        }

        $data = $this->list(...func_get_args());
        $data = collect($data);

        if (!is_subclass_of($this->defaultEntityClass, Bitrix24DTOInterface::class)){
            return $data;
        }else{
            $entityClass = $DTO ?? $this->defaultEntityClass;
        }
        return $data->map(function ($item) use ($entityClass) {
            return new $entityClass($item);
        });
    }


    /**
     * @param array $listArgs
     * @param string|null $DTO
     * @return Collection<Bitrix24DTOInterface|array>
     */
    public function getAsEntity(): Bitrix24DTOInterface|array
    {
        if (!method_exists($this, 'get')){
            throw new \BadMethodCallException('Method get() does not exist.');
        }

        $data = $this->get(...func_get_args());

        if (!is_subclass_of($this->defaultEntityClass, Bitrix24DTOInterface::class)){
            return $data;
        }else{
            $entityClass = $this->defaultEntityClass;
            return new $entityClass($data);
        }
    }
}
