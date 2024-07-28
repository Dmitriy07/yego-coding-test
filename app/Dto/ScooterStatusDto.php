<?php

namespace App\Dto;

readonly class ScooterStatusDto
{
    private function __construct(
        private int   $id,
        private int   $scooterId,
        private float $latitude,
        private float $longitude,
        private int   $battery,
    )
    {
    }

    public static function create(
        int   $id,
        int   $scooterId,
        float $latitude,
        float $longitude,
        int   $battery,
    ): ScooterStatusDto
    {
        return new self($id, $scooterId, $latitude, $longitude, $battery);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getScooterId(): int
    {
        return $this->scooterId;
    }

    public function getLatitude(): float
    {
        return $this->latitude;
    }

    public function getLongitude(): float
    {
        return $this->longitude;
    }

    public function getBattery(): int
    {
        return $this->battery;
    }

}
