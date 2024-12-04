<?php

declare(strict_types=1);

namespace Advent\Shared\Grid;

use Advent\Shared\Grid\Cell\StringCell;
use Advent\Shared\Grid\Pattern\PatternCell;
use Advent\Shared\InvalidArgumentException;

/**
 * @template T implements Cell
 */
final readonly class Grid
{
    /** @var T[] */
    private array $rows;

    private int $height;

    private int $width;

    /** @param T ...$cells */
    public function __construct(Cell ...$cells)
    {
        $rows = [];

        foreach ($cells as $cell) {
            $rows[$cell->location()->y][$cell->location()->x] = $cell;
        }

        $this->rows = $rows;
        $this->height = count($this->rows);
        $this->width = max(array_map('count', $this->rows));
    }

    public static function fromArray(array $grid): self
    {
        $cells = [];

        foreach ($grid as $y => $row) {
            foreach ($row as $x => $value) {
                $cells[] = new StringCell($x, $y, (string) $value);
            }
        }

        return new self(...$cells);
    }

    public function height(): int
    {
        return $this->height;
    }

    public function width(): int
    {
        return $this->width;
    }

    /** @return ?T */
    public function findCellAt(Location $location): ?Cell
    {
        return $this->rows[$location->y][$location->x] ?? null;
    }

    /** @return T */
    public function getCellAt(Location $location): Cell
    {
        return $this->rows[$location->y][$location->x] ?? throw InvalidArgumentException::because(
            'No cell at location [%s]',
            $location->toString()
        );
    }

    public function hasCellAt(Location $location): bool
    {
        return $this->rows[$location->y][$location->x] !== null;
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
