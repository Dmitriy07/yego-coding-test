<?php

namespace App\Console\Commands;

use App\Services\Ride as RideService;
use Illuminate\Console\Command;

class GetRidesStatistic extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:statistics {date?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get statistic of rides.';

    public function __construct(private readonly RideService $rideService)
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $date = $this->argument('date');
        if ($date !== null) {
            $this->provideRidesByHour($date);
            return;
        }

        $this->provideRidesByDate();
    }

    private function provideRidesByHour($date): void
    {
        $ridesDto = $this->rideService->getRidesByHour($date);

        $rides = $this->convertRideByHourDtoToArray($ridesDto);

        $this->table(
            ['Hours', 'Number of rides'],
            $rides
        );
    }

    private function convertRideByHourDtoToArray(array $ridesDto): array
    {
        $rides = [];
        foreach ($ridesDto as $ride) {
            $rideArray = [];
            $rideArray['hour'] = (int)$ride->getHour();
            $rideArray['number_of_rides'] = $ride->getNumberOfRides();
            $rides[] = $rideArray;
        }

        return $rides;
    }

    private function provideRidesByDate(): void
    {
        $ridesDto = $this->rideService->getRidesByDate();

        $rides = $this->convertRideByDateDtoToArray($ridesDto);

        $this->table(
            ['Date', 'Number of rides'],
            $rides
        );
    }

    private function convertRideByDateDtoToArray(array $ridesDto): array
    {
        $rides = [];
        foreach ($ridesDto as $ride) {
            $rideArray = [];
            $rideArray['date'] = $ride->getDate();
            $rideArray['number_of_rides'] = $ride->getNumberOfRides();
            $rides[] = $rideArray;
        }

        return $rides;
    }
}
