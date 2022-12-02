<?php
declare(strict_types=1);


namespace App\Entity;

class ElfCollection
{
    public function __construct(private array $elements = [])
    {

    }

    public function add(Elf $elf): void
    {
        if (false === $this->contains($elf)) {
            $this->elements[] = $elf;

            $this->sortByCalories();
        }
    }

    public function countCalories(int $length): int
    {
        $elements = array_slice($this->elements, 0, $length);

        return array_sum(array_map(static fn(Elf $elf) => $elf->countCalories(), $elements));
    }

    /**
     * @return void
     */
    private function sortByCalories(): void
    {
        usort($this->elements, function (Elf $a, Elf $b) {
            return (int) $b->countCalories() <=> $a->countCalories();
        });
    }

    public function contains(Elf $elf): bool
    {
        return array_key_exists($elf->getId(), $this->elements);
    }
}