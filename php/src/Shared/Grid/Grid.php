<?php

declare(strict_types=1);

namespace Advent\Shared\Grid;

use Advent\Shared\InvalidArgumentException;
use Traversable;

/**
 * @template T implements Cell
 * @implements \IteratorAggregate<T>
 */
final readonly class Grid implements \IteratorAggregate
{
    /** @var T[] */
    private array $cells;

    /** @param T ...$cells */
    public function __construct(Cell ...$cells)
    {
        $this->cells = array_combine(
            array_map(fn (Cell $cell) => $this->key($cell->location()), $cells),
            $cells
        );
    }

    /** @return T */
    public function getCellAt(Location $location): Cell
    {
        return $this->cells[$this->key($location)] ?? throw InvalidArgumentException::because(
            'No cell at location [%s]',
            $location->toString()
        );
    }

    /** @return ?T */
    public function findCellAt(Location $location): ?Cell
    {
        return $this->cells[$this->key($location)] ?? null;
    }

    public function hasCellAt(Location $location): bool
    {
        return $this->findCellAt($location) !== null;
    }

    /** @return Traversable<T & Cell> */
    public function getIterator(): Traversable
    {
        return new \ArrayIterator($this->cells);
    }

    private function key(Location $location): string
    {
        return $location->toString();
    }
}
