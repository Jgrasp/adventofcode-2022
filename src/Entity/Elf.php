<?php
declare(strict_types=1);


namespace App\Entity;

class Elf
{
    private array $calories = [];

    public function __construct(
        private readonly int $id
    )
    {

    }

    public function getId(): int
    {
        return $this->id;
    }

    public function addCalories(int $calories): void
    {
        $this->calories[] = $calories;
    }

    public function countCalories(): int
    {
        return array_sum($this->calories);
    }
}