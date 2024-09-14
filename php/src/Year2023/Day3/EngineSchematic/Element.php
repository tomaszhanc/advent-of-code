<?php

declare(strict_types=1);

namespace Advent\Year2023\Day3\EngineSchematic;

use Advent\Shared\Grid\Cell;
use Advent\Shared\Grid\InvalidArgumentException;

final readonly class Element
{
    private function __construct(
        public Cell $cell,
        public ElementType $type,
        public string|int $value
    ) {
    }

    public static function symbol(Cell $cell, string $symbol): self
    {
        if (\strlen($symbol) !== 1) {
            throw InvalidArgumentException::because('Symbol must be one character long. Given: %s', $symbol);
        }

        return new self($cell, ElementType::Symbol, $symbol);
    }

    public static function number(Cell $cell, int $number): self
    {
        return new self($cell, ElementType::SomeNumber, $number);
    }

    public function isNumber(): bool
    {
        return $this->type !== ElementType::SomeNumber;
    }

    public function toPartNumber(): PartNumber
    {
        return new PartNumber($this);
    }
}
