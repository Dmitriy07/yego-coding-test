<?php

namespace App\Repositories;

use App\Dto\ScooterDto;

interface Scooter
{
    public function getById($scooterId): ?ScooterDto;

    public function add(int $id, string $name, int $type): ScooterDto;
}
