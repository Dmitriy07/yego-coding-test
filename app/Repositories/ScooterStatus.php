<?php

namespace App\Repositories;

use App\Dto\ScooterStatusDto;

interface ScooterStatus
{
    public function getLast(int $scooterId): ?ScooterStatusDto;

    public function add(
        int   $scooterId,
        float $latitude,
        float $longitude,
        int   $battery
    ): ScooterStatusDto;
}
