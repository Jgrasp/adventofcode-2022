<?php
declare(strict_types=1);


namespace App\Collection;

use Webmozart\Assert\Assert;

class TypedCollection extends Collection
{
    public function __construct(private readonly string $type)
    {
        parent::__construct();
    }

    public function add($element): Collection
    {
        Assert::isInstanceOf($element, $this->type);

        return parent::add($element);
    }

    public function set(array $elements): void
    {
        $badTypeElements = array_filter($elements, static fn($element) => false === $element instanceof $this->type);
        Assert::isEmpty($badTypeElements, 'Array must be only contains instance of ' . $this->type . ' ');

        parent::set($elements);
    }
}