<?php

namespace App\Console\Commands;

use App\Src\Services\App\FileGenerator\Php\PhpMapGeneratorService;
use App\Src\Services\App\FileGenerator\Php\PhpRepositoryGeneratorService;
use App\Src\Services\App\FileGenerator\Php\PhpServiceGeneratorService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class MakeSrc extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:src {project} {directory} {entity} {action?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make all src files.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $project = $this->argument('project');
        $directory = $this->argument('directory');
        $entity = $this->argument('entity');
        $action = $this->argument('action');

        // Create service
        (new PhpServiceGeneratorService($project, $directory, $entity, $action))->generate();

        // Create repository
        (new PhpRepositoryGeneratorService($project, $directory, $entity))->generate();

        // Create mapper
        (new PhpMapGeneratorService($project, $directory, $entity))->generate();
        (new PhpMapGeneratorService($project, $directory, $entity . 'Eloquent'))->generate();
    }
}
