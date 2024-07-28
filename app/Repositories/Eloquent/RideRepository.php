<?php

namespace App\Repositories\Eloquent;

use App\Dto\RideByDateDto;
use App\Dto\RideByHourDto;
use App\Dto\RideDto;
use App\Models\Ride as RideModel;
use App\Repositories\Ride;
use Illuminate\Support\Facades\DB;

class RideRepository implements Ride
{
    public function getRidesByHour($date): array
    {
        $ridesFromDB = RideModel::select(
            DB::raw("strftime('%H',`date`) as `hour`, COUNT(*) as number_of_rides")
        )
            ->whereBetween('date', [$date . ' 00:00:00', $date . ' 23:59:59'])
            ->groupBy('hour')
            ->get();

        return $this->convertRideModelToRideByHourDto($ridesFromDB);
    }

    private function convertRideModelToRideByHourDto($ridesFromDB): array
    {
        $rides = [];
        foreach ($ridesFromDB as $ride) {
            $rides[] = RideByHourDto::create(
                $ride->hour, $ride->number_of_rides
            );
        }
        return $rides;
    }

    public function getRidesByDate(): array
    {
        $ridesFromDB = RideModel::select(
            DB::raw("DATE(`date`) as `day`, COUNT(*) as number_of_rides")
        )
            ->whereMonth('date', date('m'))
            ->groupBy('day')
            ->get();

        return $this->convertRideModelToRideByDateDto($ridesFromDB);
    }

    private function convertRideModelToRideByDateDto($ridesFromDB): array
    {
        $rides = [];
        foreach ($ridesFromDB as $ride) {
            $rides[] = RideByDateDto::create(
                $ride->day, $ride->number_of_rides
            );
        }
        return $rides;
    }

    public function add(int $scooterId): RideDto
    {
        $newRide = RideModel::create([
            'date' => now(),
            'scooter_id' => $scooterId,
        ]);

        return RideDto::create(
            date: $newRide->date,
            scooterId: $newRide->scooter_id,
        );
    }
}
