<?php

declare(strict_types=1);

namespace Advent\Shared\Grid\Pattern;

use Advent\Shared\Grid\Cell;
use Advent\Shared\Grid\Location;

/**
 * @template-implements Cell<string>
 */
final readonly class PatternCell implements Cell
{
    public function __construct(
        private Location $location,
        private string $value
    ) {
    }

    public static function any(Location $location): self
    {
        return new self($location, '.');
    }

    public function location(): Location
    {
        return $this->location;
    }

    public function value(): string
    {
        return $this->value;
    }

    public function canBeAny(): bool
    {
        return $this->value === '.';
    }
}
