<?php
declare(strict_types=1);


namespace App\Enum;

enum Shape: int
{
    case ROCK = 1;
    case PAPER = 2;
    case SCISSOR = 3;

    public static function match(string $shape): self
    {
        return match ($shape) {
            'A', 'X' => self::ROCK,
            'B', 'Y' => self::PAPER,
            'C', 'Z' => self::SCISSOR,
            default => throw new \Exception(sprintf('Shape "%s" does not match', $shape))
        };
    }

    public function winner(Shape $b): ?self
    {
        //We win against b
        if ($this->winAgainst() === $b) {
            return $this;
        }

        if ($this->defeatAgainst() === $b) {
            return $b;
        }

        return null;
    }

    public function winAgainst(): self
    {
        return match ($this) {
            self::ROCK => self::SCISSOR,
            self::SCISSOR => self::PAPER,
            self::PAPER => self::ROCK,
        };
    }

    public function defeatAgainst(): self
    {
        return match ($this) {
            self::ROCK => self::PAPER,
            self::SCISSOR => self::ROCK,
            self::PAPER => self::SCISSOR,
        };
    }
}
