<?php

namespace Tests\Feature;

use App\Dto\RideByDateDto;
use App\Dto\RideByHourDto;
use App\Repositories\Ride;
use Mockery;
use Mockery\MockInterface;
use Tests\TestCase;

class GetRidesStatisticTest extends TestCase
{
    public function testGetRidesFunctionality(): void
    {
        $this->instance(
            Ride::class,
            Mockery::mock(Ride::class, function (MockInterface $mock) {
                $mock
                    ->shouldReceive('getRidesByHour')
                    ->once()
                    ->andReturn([
                        RideByHourDto::create(
                            hour: '21',
                            numberOfRides: 15
                        )
                    ]);
                $mock
                    ->shouldReceive('getRidesByDate')
                    ->once()
                    ->andReturn([
                        RideByDateDto::create(
                            date: '2024-07-27',
                            numberOfRides: 15
                        ),
                    ]);
            })
        );


        $this->artisan('command:statistics')
            ->expectsTable([
                'Date',
                'Number of rides',
            ], [
                ['2024-07-27', 15],
            ]);

        $this->artisan('command:statistics 2024-07-27')
            ->expectsTable([
                'Hours',
                'Number of rides',
            ], [
                [21, 15],
            ]);
    }
}
