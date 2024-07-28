<?php

namespace Tests\Feature;

use App\Dto\RideDto;
use App\Dto\ScooterDto;
use App\Dto\ScooterStatusDto;
use App\Dto\TransportDto;
use App\ExternalServices\Transport;
use App\Repositories\Ride;
use App\Repositories\Scooter;
use App\Repositories\ScooterStatus;
use Mockery;
use Mockery\MockInterface;
use Tests\TestCase;

class ProcessListOfScootersTest extends TestCase
{
    public function testProcessScooters(): void
    {
        $this->instance(
            Transport::class,
            Mockery::mock(Transport::class, function (MockInterface $mock) {
                $mock
                    ->shouldReceive('get')
                    ->once()
                    ->andReturn([
                        TransportDto::create(
                            id: 649,
                            name: "Rupert",
                            latitude: 41.418012,
                            longitude: 2.177152,
                            battery: 56,
                            type: 0
                        ),
                        TransportDto::create(
                            id: 650,
                            name: "Jack",
                            latitude: 41.396163,
                            longitude: 2.125987,
                            battery: 55,
                            type: 0
                        ),
                        TransportDto::create(
                            id: 651,
                            name: "Ann",
                            latitude: 41.410843,
                            longitude: 2.188435,
                            battery: 89,
                            type: 0
                        ),
                    ]);
            })
        );

        $this->instance(
            Scooter::class,
            Mockery::mock(Scooter::class, function (MockInterface $mock) {
                $mock
                    ->shouldReceive('getById')
                    ->times(3)
                    ->andReturn(
                        null, // returned value 1
                        ScooterDto::create( // returned value 2
                            id: 21,
                            name: 'Rupert',
                            type: 0
                        )
                    );
                $mock
                    ->shouldReceive('add')
                    ->once()
                    ->andReturn(
                        ScooterDto::create(
                            id: 21,
                            name: 'Rupert',
                            type: 0
                        )
                    );
            })
        );

        $this->instance(
            ScooterStatus::class,
            Mockery::mock(ScooterStatus::class, function (MockInterface $mock) {
                $mock
                    ->shouldReceive('getLast')
                    ->times(3)
                    ->andReturn(
                        null, // returned value 1
                        ScooterStatusDto::create( // returned value 2
                            id: 1,
                            scooterId: 2,
                            latitude: 41.411843,
                            longitude: 2.198435,
                            battery: 85
                        )
                    );
                $mock
                    ->shouldReceive('add')
                    ->times(3)
                    ->andReturn(
                        ScooterStatusDto::create(
                            id: 1,
                            scooterId: 2,
                            latitude: 41.411843,
                            longitude: 2.198435,
                            battery: 85
                        )
                    );
            })
        );


        $this->instance(
            Ride::class,
            Mockery::mock(Ride::class, function (MockInterface $mock) {
                $mock
                    ->shouldReceive('add')
                    ->once()
                    ->andReturn(
                        RideDto::create(
                            '2021-01-01 00:00:00',
                            1
                        )
                    );
            })
        );

        $this->artisan('app:process-list-of-scooters')
            ->doesntExpectOutput()
            ->assertExitCode(0);
    }
}
