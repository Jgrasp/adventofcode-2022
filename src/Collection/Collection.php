<?php
declare(strict_types=1);


namespace App\Collection;

class Collection
{
    private array $elements = [];

    public function __construct()
    {
    }

    public function add($element): self
    {
        $this->elements[] = $element;
        return $this;
    }

    public function set(array $elements): void
    {
        $this->elements = $elements;
    }

    public function count(): int
    {
        return count($this->elements);
    }

    public function sort(callable $callable): self
    {
        $elements = $this->elements;

        usort($elements, $callable);

        $collection = new self();
        $collection->set($elements);

        return $collection;
    }

    public function map(callable $callable): array
    {
        return array_map($callable, $this->elements);
    }

    public function slice(int $offset, int $length): self
    {
        $elements = array_slice($this->elements, $offset, $length);
        $collection = new self();
        $collection->set($elements);

        return $collection;
    }

    public function first()
    {
        $elements = $this->elements;
        return array_shift($elements);
    }

    public function all(): array
    {
        return $this->elements;
    }
}