<?php

namespace App\Dto;

readonly class ScooterDto
{
    private function __construct(
        private int    $id,
        private string $name,
        private int    $type
    )
    {
    }

    public static function create(
        int    $id,
        string $name,
        int    $type
    ): ScooterDto
    {
        return new self($id, $name, $type);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getType(): int
    {
        return $this->type;
    }
}
