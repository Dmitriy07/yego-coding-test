<?php

namespace App\Dto;

readonly class RideByDateDto
{
    private function __construct(
        private string $date,
        private int    $numberOfRides
    )
    {
    }

    public static function create(string $date, int $numberOfRides): RideByDateDto
    {
        return new self($date, $numberOfRides);
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function getNumberOfRides(): int
    {
        return $this->numberOfRides;
    }
}
