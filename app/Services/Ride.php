<?php

namespace App\Services;

use App\Repositories\Ride as RideRepository;

readonly class Ride
{

    public function __construct(private RideRepository $ride)
    {
    }

    public function getRidesByHour($date): array
    {
        return $this->ride->getRidesByHour($date);
    }

    public function getRidesByDate(): array
    {
        return $this->ride->getRidesByDate();
    }
}
