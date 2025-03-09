<?php

declare(strict_types=1);

namespace OlexinPro\Bitrix24\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use OlexinPro\Bitrix24\Contracts\Generator\GeneratorInterface;
use OlexinPro\Bitrix24\Facades\Bitrix24Rest;

class GenerateBitrix24DTO extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bitrix24:dto
                          {entity : The Bitrix24 entity name }
                          {class-name? : The name of the DTO class}
                          {--force : Force the operation to run when DTO already exists}
                          {--with-products : Add products field to DTO}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate or update DTOs from Bitrix24 for a specific entity';

    public function __construct(
        private readonly GeneratorInterface $generator
    ) {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $entity = $this->argument('entity');
        $className = $this->resolveClassName($entity);
        $force = $this->option('force');
        $withProducts = $this->option('with-products');

        try {
            $fields = $this->fetchFieldsFromBitrix24(mb_strtolower($entity));

            $this->generator->generate($className, $fields, $force, $withProducts);

            $this->info("DTO {$className} for entity {$entity} created successfully!");
            return Command::SUCCESS;
        } catch (\Exception $e) {
            $this->error($e->getMessage());
            return Command::FAILURE;
        }
    }

    private function resolveClassName(string $entity): string
    {
        $customClassName = $this->argument('class-name');
        if ($customClassName !== null) {
            return $customClassName;
        }

        return Str::studly($entity) . 'DTO';
    }

    private function fetchFieldsFromBitrix24(string $entity): Collection
    {
        return match ($entity){
            'lead' => Bitrix24Rest::crm()->lead()->fieldsCollection(),
            'deal' => Bitrix24Rest::crm()->deal()->fieldsCollection(),
            'offer' => Bitrix24Rest::crm()->offer()->fieldsCollection(),
            'contact' => Bitrix24Rest::crm()->contact()->fieldsCollection(),
            'company' => Bitrix24Rest::crm()->company()->fieldsCollection(),
            default => throw new \InvalidArgumentException("Entity \"$entity\" is not support ")
        };
    }
}
