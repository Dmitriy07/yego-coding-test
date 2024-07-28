<?php

namespace App\Dto;

readonly class TransportDto
{
    private function __construct(
        private int    $id,
        private string $name,
        private float  $latitude,
        private float  $longitude,
        private int    $battery,
        private int    $type
    )
    {
    }

    public static function create(
        int    $id,
        string $name,
        float  $latitude,
        float  $longitude,
        int    $battery,
        int    $type
    ): TransportDto
    {
        return new self($id, $name, $latitude, $longitude, $battery, $type);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
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

    public function getType(): int
    {
        return $this->type;
    }
}
