<?php

declare(strict_types=1);

namespace Advent\Shared\Grid;

use Advent\Shared\Grid\Pattern\PatternCell;

final readonly class Pattern
{
    /** @var PatternCell[] */
    private array $cells;

    private int $height;

    private int $width;

    public function __construct(PatternCell ...$cells)
    {
        $rows = [];
        foreach ($cells as $cell) {
            $rows[$cell->y][$cell->x] = $cell;
        }

        $this->cells = $cells;
        $this->height = count($rows);
        $this->width = max(array_map('count', $rows));
    }

    public static function fromArray(array $pattern): self
    {
        $cells = [];

        foreach ($pattern as $y => $row) {
            foreach ($row as $x => $value) {
                $cells[] = new PatternCell($x, $y, $value);
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

    /** @return PatternCell[] */
    public function expectedPatternCells(): iterable
    {
        foreach ($this->cells as $patternCell) {
            if (!$patternCell->mustMatch()) {
                continue;
            }

            yield $patternCell;
        }
    }
}
