<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use OpenApi\Generator;
use Exception;

class ApiDocsGenerate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'api:docs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generates the OpenApi documents for the app';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $openApi = Generator::scan([base_path().'/app']);

        header('Content-Type: application/x-yaml');
        try {
            Storage::disk('public')->put('api-docs/openapi.json', $openApi->toJson());

            $this->components->info('API Docs generated successfully! Access them at : '.env('APP_URL').'/api-docs');
        } catch (Exception $e) {
            echo 'ERROR : '.$e->getMessage();
        }
    }
}
