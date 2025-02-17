<?php

namespace OlexinPro\Bitrix24\Entities\DTO;

final readonly class Bitrix24FieldDescriptionDTO
{
    public string $field;
    public string $type;
    public bool $isRequired;
    public bool $isReadOnly;
    public bool $isImmutable;
    public bool $isMultiple;
    public bool $isDynamic;
    public string $title;
    public ?string $listLabel;
    public ?string $formLabel;
    public ?string $filterLabel;
    public ?array $settings;

    public function __construct(
        string $field,
        string $type,
        bool $isRequired,
        bool $isReadOnly,
        bool $isImmutable,
        bool $isMultiple,
        bool $isDynamic,
        string $title,
        ?string $listLabel = null,
        ?string $formLabel = null,
        ?string $filterLabel = null,
        ?array $settings = null
    ) {
        $this->field = $field;
        $this->type = $type;
        $this->isRequired = $isRequired;
        $this->isReadOnly = $isReadOnly;
        $this->isImmutable = $isImmutable;
        $this->isMultiple = $isMultiple;
        $this->isDynamic = $isDynamic;
        $this->title = $title;
        $this->listLabel = $listLabel;
        $this->formLabel = $formLabel;
        $this->filterLabel = $filterLabel;
        $this->settings = $settings;
    }

    public static function fromArray(string $field, array $data): self
    {
        return new self(
            $field,
            $data['type'],
            $data['isRequired'],
            $data['isReadOnly'],
            $data['isImmutable'],
            $data['isMultiple'],
            $data['isDynamic'],
            $data['title'],
            $data['listLabel'] ?? null,
            $data['formLabel'] ?? null,
            $data['filterLabel'] ?? null,
            $data['settings'] ?? null
        );
    }
}