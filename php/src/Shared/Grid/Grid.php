<?php

declare(strict_types=1);

namespace Advent\Shared\Grid;

use Advent\Shared\Grid\Cell\StringCell;
use Advent\Shared\Grid\Pattern\PatternCell;
use Advent\Shared\Grid\Pattern\SubGridCell;
use Advent\Shared\InvalidArgumentException;
use Advent\Shared\RuntimeException;

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

    public static function fromArray(array $grid): self
    {
        $cells = [];

        foreach ($grid as $y => $row) {
            foreach ($row as $x => $value) {
                $cells[] = new StringCell(new Location($x, $y), (string) $value);
            }
        }

        return new self(...$cells);
    }

    public static function fromPattern(array $pattern): self
    {
        $cells = [];

        foreach ($pattern as $y => $row) {
            foreach ($row as $x => $value) {
                $cells[] = new PatternCell(new Location($x, $y), $value);
            }
        }

        return new self(...$cells);
    }

    public function height(): int
    {
        return count($this->rows);
    }

    public function width(): int
    {
        return max(array_map('count', $this->rows));
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

    public function subGrids(int $sizeX, int $sizeY): iterable
    {
        foreach ($this->allCells() as $cell) {
            if ($cell->location()->x + $sizeX > $this->width()) {
                continue;
            }

            if ($cell->location()->y + $sizeY > $this->height()) {
                continue;
            }

            yield $this->subGrid($cell->location(), $sizeX, $sizeY);
        }
    }

    public function subGrid(Location $start, int $sizeX, int $sizeY): Grid
    {
        $cells = [];

        for ($x = $start->x, $newX = 0; $x < $start->x + $sizeX; $x++, $newX++) {
            for ($y = $start->y, $newY = 0; $y < $start->y + $sizeY; $y++, $newY++) {
                if (!$this->hasCellAt(new Location($x, $y))) {
                    throw RuntimeException::because('Cannot create subgrid [%dx%d] starting from cell %s', $sizeX, $sizeY, $start->toString());
                }

                $cells[] = new SubGridCell(
                    $this->getCellAt(new Location($x, $y)),
                    new Location($newX, $newY)
                );
            }
        }

        return new Grid(...$cells);
    }

    public function toArray()
    {
        $rows = [];

        foreach ($this->allRows() as $row) {
            $stringRow = '';
            foreach ($row as $cell) {
                $stringRow .= $cell->value();
            }
            $rows[] = $stringRow;
        }

        return $rows;
    }
}
