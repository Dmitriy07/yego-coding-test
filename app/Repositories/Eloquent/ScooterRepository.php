<?php

namespace App\Repositories\Eloquent;

use App\Dto\ScooterDto;
use App\Models\Scooter as ScooterModel;
use App\Repositories\Scooter;

class ScooterRepository implements Scooter
{

    public function getById($scooterId): ?ScooterDto
    {
        $scooter = ScooterModel::where('id', '=', $scooterId)->first();
        if ($scooter === null) {
            return null;
        }

        return ScooterDto::create(
            id: $scooter->id,
            name: $scooter->name,
            type: $scooter->type
        );
    }

    public function add(int $id, string $name, int $type): ScooterDto
    {
        $newScooter = ScooterModel::create([
            'id' => $id,
            'name' => $name,
            'type' => $type,
        ]);

        return ScooterDto::create(
            id: $newScooter->id,
            name: $newScooter->name,
            type: $newScooter->type
        );
    }
}
