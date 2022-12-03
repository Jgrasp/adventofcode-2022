<?php
declare(strict_types=1);


namespace App\Collection;

use Exception;

class TypedCollection extends Collection
{
    public function __construct(private readonly string $type)
    {
        parent::__construct();
    }

    public function add($element): Collection
    {
        if (false === $element instanceof $this->type) {
            throw new Exception('$element must be an instance of ' . $this->type);
        }

        return parent::add($element);
    }

    public function set(array $elements): void
    {
        $badTypeElements = array_filter($elements, static fn($element) => false === $element instanceof $this->type);

        if (false === empty($badTypeElements)) {
            throw new Exception('Array must be only contains instance of ' . $this->type);
        }

        parent::set($elements);
    }
}