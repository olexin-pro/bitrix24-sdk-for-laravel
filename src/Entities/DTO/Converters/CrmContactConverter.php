<?php

declare(strict_types=1);

namespace OlexinPro\Bitrix24\Entities\DTO\Converters;

use OlexinPro\Bitrix24\Entities\DTO\Fields\CrmContactField;

final class CrmContactConverter implements Bitrix24TypeConverterInterface
{
    /**
     * @return array<CrmContactField>|null
     */
    public function convert($value): null|array
    {
        if(is_null($value)){
            return null;
        }

        if (!is_array($value)) {
            throw new \InvalidArgumentException('Value must be an array');
        }

        return collect($value)->map(function ($contactField) {
            $contactField = $this->transformKeys($contactField);
            if (!array_key_exists('value', $contactField)) {
                return null;
            }
            return new CrmContactField($contactField);
        })->filter()->toArray();
    }

    private function transformKeys(array $data)
    {
        $transformed = [];
        foreach ($data as $key => $value) {
            $transformed[$this->normalizeKey($key)] = $value;
        }
        return $transformed;
    }

    private function normalizeKey(string $key): string
    {
        $key = preg_replace('/([a-z])([A-Z])/', '$1_$2', $key);
        return strtolower($key);
    }
}
