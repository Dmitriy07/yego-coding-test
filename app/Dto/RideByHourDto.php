<?php

namespace App\Dto;

readonly class RideByHourDto
{
    private function __construct(
        private string $hour,
        private int    $numberOfRides
    )
    {
    }

    public static function create(string $hour, int $numberOfRides): RideByHourDto
    {
        return new self($hour, $numberOfRides);
    }

    public function getHour(): string
    {
        return $this->hour;
    }

    public function getNumberOfRides(): int
    {
        return $this->numberOfRides;
    }
}
