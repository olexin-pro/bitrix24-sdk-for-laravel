<?php

declare(strict_types=1);

namespace OlexinPro\Bitrix24\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Event;
use OlexinPro\Bitrix24\Entities\Bitrix24Event;

class Bitrix24EventService
{
    public function handleEvent(Bitrix24Event $event): void
    {
        $eventName = $event->eventName;
        $laravelEventName = $this->getLaravelEvent($eventName);
        if ($laravelEventName) {
            event(new $laravelEventName($event));
        }
    }

    private function getLaravelEvent(string $eventName): ?string
    {
        $normalizedInput = strtoupper(preg_replace('/[^a-zA-Z0-9]/', '', $eventName));

        $cacheKey = config('bitrix24.events.laravel_event_classes_cache_key', 'laravel_event_classes');

        $events = Cache::rememberForever($cacheKey, function () {
            $events = [];
            $eventClasses = array_keys(Event::getRawListeners());

            foreach ($eventClasses as $eventClass) {
                if (!class_exists($eventClass)) {
                    continue;
                }

                $className = class_basename($eventClass);
                $spacedName = preg_replace('/(?<!^)([A-Z])/', ' $1', $className);
                $laravelEventName = strtoupper(preg_replace('/[^a-zA-Z0-9]/', '', $spacedName));
                $events[$laravelEventName] = $eventClass;
            }

            return $events;
        });

        return $events[$normalizedInput] ?? null;
    }

}
