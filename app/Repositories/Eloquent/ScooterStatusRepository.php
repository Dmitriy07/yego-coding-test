<?php

namespace App\Repositories\Eloquent;

use App\Dto\ScooterStatusDto;
use App\Models\ScooterStatus as ScooterStatusModel;
use App\Repositories\ScooterStatus;

class ScooterStatusRepository implements ScooterStatus
{

    public function getLast(int $scooterId): ?ScooterStatusDto
    {
        $lastScooterStatus = ScooterStatusModel::where('scooter_id', '=', $scooterId)
            ->orderBy('id', 'desc')
            ->first();
        if ($lastScooterStatus === null) {
            return null;
        }

        return ScooterStatusDto::create(
            id: $lastScooterStatus->id,
            scooterId: $lastScooterStatus->scooter_id,
            latitude: $lastScooterStatus->lat,
            longitude: $lastScooterStatus->lng,
            battery: $lastScooterStatus->battery
        );
    }

    public function add(
        int   $scooterId,
        float $latitude,
        float $longitude,
        int   $battery
    ): ScooterStatusDto
    {
        $newScooterStatus = ScooterStatusModel::create([
            'scooter_id' => $scooterId,
            'lat' => $latitude,
            'lng' => $longitude,
            'battery' => $battery,
        ]);

        return ScooterStatusDto::create(
            id: $newScooterStatus->id,
            scooterId: $newScooterStatus->scooter_id,
            latitude: $newScooterStatus->lat,
            longitude: $newScooterStatus->lng,
            battery: $newScooterStatus->battery
        );
    }
}
