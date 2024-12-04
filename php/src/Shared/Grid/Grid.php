<?php

declare(strict_types=1);

namespace Advent\Shared\Grid;

use Advent\Shared\InvalidArgumentException;

/**
 * @template T implements Cell
 */
final readonly class Grid
{
    /** @var T[] */
    private array $rows;

    /** @param T ...$cells */
    public function __construct(Cell ...$cells)
    {
        $rows = [];

        foreach ($cells as $cell) {
            $rows[$cell->location()->y][$cell->location()->x] = $cell;
        }

        $this->rows = $rows;
    }

    /** @return ?T */
    public function findCellAt(Location $location): ?Cell
    {
        return $this->rows[$location->y][$location->x] ?? null;
    }

    /** @return T */
    public function getCellAt(Location $location): Cell
    {
        return $this->findCellAt($location) ?? throw InvalidArgumentException::because(
            'No cell at location [%s]',
            $location->toString()
        );
    }

    public function hasCellAt(Location $location): bool
    {
        return $this->findCellAt($location) !== null;
    }

    /** @return array<T & Cell[]> */
    public function allRows(): iterable
    {
        foreach ($this->rows as $row) {
            yield $row;
        }
    }

    /** @return array<T & Cell[]> */
    public function allColumns(): iterable
    {
        $columns = [];

        foreach ($this->rows as $row) {
            foreach ($row as $x => $cell) {
                $columns[$x][] = $cell;
            }
        }

        return $columns;
    }

    /** @return T & Cell[] */
    public function allDiagonals(): iterable
    {
        $leftToRightDiagonals = [];
        $rightToLeftDiagonals = [];

        foreach ($this->allCells() as $cell) {
            $x = $cell->location()->x;
            $y = $cell->location()->y;

            $leftToRightDiagonals[$x - $y][] = $cell;
            $rightToLeftDiagonals[$x + $y][] = $cell;
        }

        // TODO sort diagonals

        return array_values([...$leftToRightDiagonals, ...$rightToLeftDiagonals]);
    }

    /** @return T & Cell[] */
    public function allCells(): iterable
    {
        foreach ($this->rows as $row) {
            foreach ($row as $cell) {
                yield $cell;
            }
        }
    }
}
