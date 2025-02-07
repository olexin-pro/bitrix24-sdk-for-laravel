<?php

namespace OlexinPro\Bitrix24\Entities\DTO;

use InvalidArgumentException;
use ReflectionAttribute;
use ReflectionClass;
use ReflectionProperty;
use OlexinPro\Bitrix24\Entities\DTO\Converters\{
    Bitrix24TypeConverterInterface,
    ArrayConverter,
    BooleanConverter,
    CollectionConverter,
    DateConverter,
    DynamicConverter,
    FloatConverter,
    IntConverter,
    StringConverter
};

abstract class AbstractBitrix24DTO
{

    protected array $data;
    protected array $converters = [];
    private static array $reflectionCache = [];

    public function __construct(array $data)
    {
        $this->data = $this->transformKeys($data);
        $this->initializeFields();
    }

    public function getRawData(): array
    {
        return $this->data;
    }

    private function initializeFields(): void
    {
        $reflection = $this->getReflection();

        foreach ($reflection->getProperties() as $property) {
            $attributes = $property->getAttributes(Bitrix24Field::class);

            foreach ($attributes as $attribute) {
                $this->processAttribute($attribute, $property);
            }
        }
    }

    private function processAttribute(ReflectionAttribute $attribute, ReflectionProperty $property): void
    {
        /** @var Bitrix24Field $attrInstance */
        $attrInstance = $attribute->newInstance();

        $this->validateField($attrInstance, $property);
        $value = $this->getFieldValue($attrInstance);
        $converter = $this->resolveConverter($attrInstance->type);

        $property->setValue($this, $converter->convert($value));
    }

    private function validateField(Bitrix24Field $attribute, ReflectionProperty $property): void
    {
        if ($attribute->required && !array_key_exists($this->normalizeKey($attribute->fieldName), $this->data)) {

            throw new InvalidArgumentException(
                "Missing required field '{$attribute->fieldName}' for property {$property->getName()}"
            );
        }
    }


    private function getFieldValue(Bitrix24Field $attribute): mixed
    {
        return $this->data[$this->normalizeKey($attribute->fieldName)] ?? null;
    }

    private function resolveConverter(Bitrix24TypeEnum|Bitrix24TypeConverterInterface $type): Bitrix24TypeConverterInterface
    {
        return match (true) {
            $type instanceof Bitrix24TypeConverterInterface => $type,
            default => $this->getConverterFromEnum($type)
        };
    }

    protected function transformKeys(array $data): array
    {
        $transformed = [];
        foreach ($data as $key => $value) {
            $transformed[$this->normalizeKey($key)] = blank($value) ? null : $value;
        }
        return $transformed;
    }

    protected function normalizeKey(string $key): string
    {
        $key = preg_replace('/([a-z])([A-Z])/', '$1_$2', $key);
        return strtolower($key);
    }

    private function getConverterFromEnum(Bitrix24TypeEnum $type): Bitrix24TypeConverterInterface
    {

        if (!isset($this->converters[$type->value])) {
            $this->converters[$type->value] = match ($type) {
                Bitrix24TypeEnum::ARRAY => new ArrayConverter(),
                Bitrix24TypeEnum::COLLECTION => new CollectionConverter(),
                Bitrix24TypeEnum::INT => new IntConverter(),
                Bitrix24TypeEnum::FLOAT => new FloatConverter(),
                Bitrix24TypeEnum::STRING => new StringConverter(),
                Bitrix24TypeEnum::DATE => new DateConverter(),
                Bitrix24TypeEnum::BOOLEAN => new BooleanConverter(),
                default => new DynamicConverter(),
            };
        }
        return $this->converters[$type->value];
    }

    private function getReflection(): ReflectionClass
    {
        $class = static::class;

        if (!isset(self::$reflectionCache[$class])) {
            self::$reflectionCache[$class] = new ReflectionClass(static::class);
        }

        return self::$reflectionCache[$class];
    }

    public function getUserFields(string $prefix = 'uf'): array
    {
        return array_filter(
            $this->data,
            fn($key) => str_starts_with(mb_strtolower($key), mb_strtolower($prefix)),
            ARRAY_FILTER_USE_KEY
        );
    }

}
