<?php

namespace OlexinPro\Bitrix24\Services\Generator;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use InvalidArgumentException;
use OlexinPro\Bitrix24\Contracts\Generator\ConfigurationInterface;
use OlexinPro\Bitrix24\Contracts\Generator\GeneratorInterface;
use OlexinPro\Bitrix24\Contracts\Generator\StubRendererInterface;
use OlexinPro\Bitrix24\Entities\DTO\Bitrix24FieldDescriptionDTO;
use OlexinPro\Bitrix24\Entities\DTO\Bitrix24TypeEnum;

final readonly class Generator implements GeneratorInterface
{
    public function __construct(
        private ConfigurationInterface $config,
        private StubRendererInterface $stubRenderer
    ) {
    }

    public function generate(string $className, Collection $fields, bool $force = false, bool $withProducts = false): void
    {
        $filePath = $this->getFilePath($className);

        if (file_exists($filePath) && !$force) {
            throw new InvalidArgumentException("DTO $className already exists!");
        }

        $this->createDirectory(dirname($filePath));

        $content = $this->stubRenderer->render(
            $this->config->getStubPath(),
            $this->prepareReplacements($className, $fields, $withProducts)
        );

        file_put_contents($filePath, $content);
    }

    private function getFilePath(string $className): string
    {
        return $this->config->getPath() . '/' . $className . '.php';
    }

    private function createDirectory(string $directory): void
    {
        if (!is_dir($directory)) {
            mkdir($directory, 0755, true);
        }
    }

    private function prepareReplacements(string $className, Collection $fields, bool $withProducts): array
    {
        return [
            '{{ namespace }}' => $this->config->getNamespace(),
            '{{ class }}' => $className,
            '{{ properties }}' => $this->generateProperties($fields, $withProducts),
            '{{ imports }}' => $this->generateImports($fields, $withProducts),
        ];
    }

    private function generateProperties(Collection $fields, bool $withProducts): string
    {
        $properties = $fields->map(function (Bitrix24FieldDescriptionDTO $field) {
            $type = $this->mapFieldType($field);
            $propertyName = $this->formatPropertyName($field->field);
            $attribute = $this->generateAttribute($field);

            return <<<PHP
    
    {$attribute}
    public {$type} \${$propertyName};
PHP;
        });
        if ($withProducts) {
            $properties->push(
                <<<PHP
    
    #[Bitrix24Field(self::PRODUCT_ROWS_KEY, CrmProductRowConverter::class)]
    public ?Collection \$products;
PHP
            );
        }

        return $properties->implode("\n");
    }

    private function generateImports(Collection $fields, bool $withProducts): string
    {
        $imports = collect([
            'OlexinPro\Bitrix24\Entities\DTO\AbstractBitrix24DTO',
            'OlexinPro\Bitrix24\Entities\DTO\Bitrix24Field',
            'OlexinPro\Bitrix24\Entities\DTO\Bitrix24TypeEnum',
        ]);

        if ($fields->contains(fn($field) => $field->type === 'crm_contact')) {
            $imports->push('Illuminate\Support\Collection');
        }

        if ($withProducts) {
            $imports->push('OlexinPro\Bitrix24\Entities\DTO\Converters\CrmProductRowConverter');
        }

        return $imports->unique()
            ->map(fn($import) => "use $import;")
            ->implode("\n");
    }

    private function mapFieldType(Bitrix24FieldDescriptionDTO $field): string
    {
        $baseTypes = config('bitrix24.generator.match_php_types', []);
        $contactType = $this->getBitrixFieldMappingType($field);
        $baseType = $baseTypes[$field->type] ?? 'mixed';

        if ($field->isMultiple && $contactType !== Bitrix24TypeEnum::CRM_CONTACT_FIELD->name) {
            return 'array';
        }

        return ($field->isRequired
            ? $baseType
            : ($baseType !== 'mixed' ? "?$baseType" : $baseType)
        );
    }

    private function getBitrixFieldMappingType(Bitrix24FieldDescriptionDTO $field): string
    {
        $typeMapping = $this->config->getTypeMapping();
        return $typeMapping[$field->type] ?? Bitrix24TypeEnum::DYNAMIC->name;
    }

    private function formatPropertyName(string $fieldName): string
    {
        return Str::camel(strtolower($fieldName));
    }

    private function generateAttribute(Bitrix24FieldDescriptionDTO $field): string
    {
        $type = $this->getBitrixFieldMappingType($field);
        $isRequired = $field->isRequired ? 'true' : 'false';

        if ($field->isMultiple && $type !== Bitrix24TypeEnum::CRM_CONTACT_FIELD->name) {
            $type = Bitrix24TypeEnum::ARRAY->name;
        }

        return <<<PHP
#[Bitrix24Field('{$field->field}', Bitrix24TypeEnum::{$type}, {$isRequired})]
PHP;
    }
}