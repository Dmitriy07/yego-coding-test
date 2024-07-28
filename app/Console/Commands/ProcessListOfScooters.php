<?php

namespace App\Console\Commands;

use App\Services\Scooter as ScooterService;
use Illuminate\Console\Command;

class ProcessListOfScooters extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:process-list-of-scooters';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Processing the list of scooters from the API.';

    public function __construct(private readonly ScooterService $scooterService)
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->scooterService->processScooters();
    }
}
