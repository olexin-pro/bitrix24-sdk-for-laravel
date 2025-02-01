<?php

declare(strict_types=1);

namespace OlexinPro\Bitrix24\Console\Commands;

use Illuminate\Console\Command;
use OlexinPro\Bitrix24\Services\Bitrix24EventService;

class LoadOfflineEventsFromBitrix24 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bitrix:load-offline-events {--C|clear: Clear events after load}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Load offline events from bitrix24';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $bitrixEvents = Bitrix24RestApi::events();
        $bitrixEventService = new Bitrix24EventService();
        $events = $bitrixEvents->getOfflineEventsCollection(clear: true);

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
