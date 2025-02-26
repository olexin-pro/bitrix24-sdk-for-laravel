<?php

declare(strict_types=1);

namespace OlexinPro\Bitrix24\Console\Commands;

use Illuminate\Console\Command;
use OlexinPro\Bitrix24\Facades\Bitrix24Rest;
use OlexinPro\Bitrix24\Services\Bitrix24EventService;

class LoadOfflineEventsFromBitrix24 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bitrix24:load-offline-events';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Load offline events from bitrix24 and dispatch Laravel events based on them';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $bitrixEvents = Bitrix24Rest::events();
        $bitrixEventService = new Bitrix24EventService();
        $events = $bitrixEvents->offlineGetAsCollection(clear: true);

        if (blank($events)) {
            $this->line('No events found.');
            return Command::SUCCESS;
        }

        $eventsProcessed = 0;
        foreach ($events as $event) {
            $bitrixEventService->handleEvent($event);
            $eventsProcessed++;
        }

        if ($eventsProcessed === 0) {
            $this->line('No events were processed.');
        } else {
            $this->line("Processed {$eventsProcessed} events.");
        }

        return Command::SUCCESS;
    }
}
