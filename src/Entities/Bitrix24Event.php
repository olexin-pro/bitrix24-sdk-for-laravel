<?php

declare(strict_types=1);

namespace OlexinPro\Bitrix24\Entities;

use InvalidArgumentException;

final class Bitrix24Event
{
    public string $eventId;
    public string $timestamp;
    public string $eventName;
    public array $eventData;
    public array $eventAdditional;
    public string $messageId;

    /**
     * Bitrix24Event constructor.
     *
     * Initializes a new Bitrix24Event object with the provided event data.
     *
     * @param array $data An associative array containing event data.
     * @throws InvalidArgumentException If any required field is missing in the provided data.
     */
    public function __construct(array $data)
    {
        $this->eventId = $data['ID'] ?? throw new InvalidArgumentException('Missing event ID');
        $this->timestamp = $data['TIMESTAMP_X'] ?? throw new InvalidArgumentException('Missing timestamp');
        $this->eventName = $data['EVENT_NAME'] ?? throw new InvalidArgumentException('Missing event name');
        $this->eventData = $data['EVENT_DATA'] ?? throw new InvalidArgumentException('Missing event data');
        $this->eventAdditional = $data['EVENT_ADDITIONAL'] ?? [];
        $this->messageId = $data['MESSAGE_ID'] ?? throw new InvalidArgumentException('Missing message ID');
    }

    /**
     * Retrieves the entity ID from the event data.
     *
     * @return mixed|null The entity ID or null if not found.
     */
    public function getEntityId(): mixed
    {
        return $this->eventData['FIELDS']['ID'] ?? null;
    }

    /**
     * Retrieves the entity type ID from the event data.
     *
     * @return mixed|null The entity type ID or null if not found.
     */
    public function getEntityTypeId(): mixed
    {
        return $this->eventData['FIELDS']['ENTITY_TYPE_ID'] ?? null;
    }

    /**
     * Checks if the event data contains an entity type ID.
     *
     * @return bool True if the entity type ID is present, false otherwise.
     */
    public function hasEntityType(): bool
    {
        return !empty($this->eventData['FIELDS']['ENTITY_TYPE_ID']);
    }

    /**
     * Retrieves a specific value from the event data.
     *
     * @param string $key The key of the value to retrieve.
     * @param mixed $default The default value to return if the key is not found (default is null).
     * @return mixed The value associated with the given key or the default value if the key is not found.
     */
    public function getEventDataValue(string $key, mixed $default = null): mixed
    {
        return $this->eventData[$key] ?? $default;
    }
}
