<?php

namespace App\Services;

class DistanceCalculator
{
    public function calculate(
        float $startLatitude,
        float $startLongitude,
        float $endLatitude,
        float $endLongitude
    ): int
    {
        $pi80 = M_PI / 180;
        $startLatitude *= $pi80;
        $startLongitude *= $pi80;
        $endLatitude *= $pi80;
        $endLongitude *= $pi80;

        $deltaLatitude = $endLatitude - $startLatitude;
        $deltaLongitude = $endLongitude - $startLongitude;
        $angle = sin($deltaLatitude / 2) * sin($deltaLatitude / 2) + cos($startLatitude) * cos($endLatitude) * sin($deltaLongitude / 2) * sin($deltaLongitude / 2);
        $c = 2 * atan2(sqrt($angle), sqrt(1 - $angle));
        $radiusOfEarthInKm = 6372.797;
        $distanceInKilometers = $radiusOfEarthInKm * $c;
        $distanceInMeters = $distanceInKilometers * 1000;

        return round($distanceInMeters, 0);
    }
}
