<?php

namespace App\Services;

use App\ExternalServices\Transport;
use App\Repositories\Ride;
use App\Repositories\Scooter as ScooterRepository;
use App\Repositories\ScooterStatus;

readonly class Scooter
{
    const MINIMAL_RIDE_DISTANCE = 60;

    public function __construct(
        private ScooterRepository  $scooter,
        private ScooterStatus      $scooterStatus,
        private Ride               $ride,
        private Transport          $transport,
        private DistanceCalculator $distanceCalculator
    )
    {
    }

    public function processScooters(): void
    {
        $transportDtos = $this->getScootersFromApi();

        foreach ($transportDtos as $transportDto) {
            $scooterDto = $this->scooter->getById($transportDto->getId());

            if ($scooterDto === null) {
                $scooterDto = $this->scooter->add(
                    $transportDto->getId(),
                    $transportDto->getName(),
                    $transportDto->getType()
                );
            }

            $lastScooterStatusDto = $this->scooterStatus->getLast($scooterDto->getId());

            if ($lastScooterStatusDto === null) {
                $this->scooterStatus->add(
                    $scooterDto->getId(),
                    $transportDto->getLatitude(),
                    $transportDto->getLongitude(),
                    $transportDto->getBattery()
                );
                continue;
            }

            $distance = $this->distanceCalculator->calculate(
                $lastScooterStatusDto->getLatitude(),
                $lastScooterStatusDto->getLongitude(),
                $transportDto->getLatitude(),
                $transportDto->getLongitude()
            );

            $isBatteryPercentageSmaller = $transportDto->getBattery() < $lastScooterStatusDto->getBattery();

            if ($distance > self::MINIMAL_RIDE_DISTANCE && $isBatteryPercentageSmaller) {
                $this->ride->add($scooterDto->getId());
            }

            $this->scooterStatus->add(
                $scooterDto->getId(),
                $transportDto->getLatitude(),
                $transportDto->getLongitude(),
                $transportDto->getBattery()
            );
        }
    }

    private function getScootersFromApi(): array
    {
        return $this->transport->get();
    }
}
