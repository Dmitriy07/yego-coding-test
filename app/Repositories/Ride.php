<?php

namespace App\Repositories;

use App\Dto\RideDto;

interface Ride
{
    public function getRidesByHour(string $date): array;

    public function getRidesByDate(): array;

    public function add(int $scooterId): RideDto;
}
