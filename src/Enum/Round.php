<?php
declare(strict_types=1);


namespace App\Enum;

enum Round: int
{
    case WIN = 6;
    case DRAW = 3;
    case DEFEAT = 0;

    public static function play(Shape $player1, Shape $player2): int
    {
        $points = match ($player2->winner($player1)) {
            $player2 => self::WIN,
            $player1 => self::DEFEAT,
            default => self::DRAW
        };

        return $player2->value + $points->value;
    }

    public static function match(string $shape): self
    {
        return match ($shape) {
            'X' => self::DEFEAT,
            'Y' => self::DRAW,
            'Z' => self::WIN,
            default => throw new \Exception("Shape can not be match with round result")
        };
    }
}