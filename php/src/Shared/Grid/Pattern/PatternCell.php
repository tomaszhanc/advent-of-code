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
        private int $x,
        private int $y,
        private string $value
    ) {
    }

    public function location(): Location
    {
        return new Location($this->x, $this->y);
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
