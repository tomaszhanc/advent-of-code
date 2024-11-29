<?php

declare(strict_types=1);

namespace Advent\Shared\Grid;

use Advent\Shared\InvalidArgumentException;
use Traversable;

/**
 * @template T implements GridCell
 * @implements \IteratorAggregate<T>
 */
final readonly class GridCells implements \IteratorAggregate
{
    /** @var T[] */
    private array $cells;

    /** @param T ...$cells */
    public function __construct(GridCell ...$cells)
    {
        $this->cells = array_combine(
            array_map(fn (GridCell $cell) => $this->key($cell->location()), $cells),
            $cells
        );
    }

    /** @return T */
    public function getAt(Location $location): GridCell
    {
        return $this->cells[$this->key($location)] ?? throw InvalidArgumentException::because(
            'No cell at location [%s]',
            $location->toString()
        );
    }

    /** @return ?T */
    public function findAt(Location $location): ?GridCell
    {
        return $this->cells[$this->key($location)] ?? null;
    }

    public function hasAt(Location $location): bool
    {
        return $this->findAt($location) !== null;
    }

    public function getIterator(): Traversable
    {
        return new \ArrayIterator($this->cells);
    }

    private function key(Location $location): string
    {
        return $location->toString();
    }
}
