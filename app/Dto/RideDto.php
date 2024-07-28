<?php

namespace App\Dto;

readonly class RideDto
{
    private function __construct(
        private string $date,
        private int    $scooterId
    )
    {
    }

    public static function create(
        string $date,
        int    $scooterId
    ): RideDto
    {
        return new self($date, $scooterId);
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function getScooterId(): int
    {
        return $this->scooterId;
    }
}
