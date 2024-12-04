<?php

declare(strict_types=1);

namespace Advent\Shared\Grid\Pattern;

use Advent\Shared\Grid\Grid;
use Advent\Shared\Grid\Location;
use Advent\Shared\Grid\Pattern;

final readonly class PatternMatcher
{
    /** @var Pattern[] */
    private array $patterns;

    public function __construct(Pattern ...$patterns)
    {
        $this->patterns = $patterns;
    }

    /** @return Grid[] */
    public function matchIn(Grid $grid): iterable
    {
        foreach ($this->patterns as $pattern) {
            $sizeX = $pattern->width();
            $sizeY = $pattern->height();

            foreach ($grid->allCells() as $cell) {
                if ($cell->location()->x + $sizeX > $grid->width()) {
                    continue;
                }

                if ($cell->location()->y + $sizeY > $grid->height()) {
                    continue;
                }

                $matchedSubGrid = $this->matchPatternStartingAt($cell->location(), $pattern, $grid);

                if ($matchedSubGrid !== null) {
                    yield $matchedSubGrid;
                }
            }
        }
    }

    private function matchPatternStartingAt(Location $start, Pattern $pattern, Grid $grid): ?Grid
    {
        $cells = [];

        foreach ($pattern->expectedPatternCells() as $patternCell) {
            $x = $patternCell->x + $start->x;
            $y = $patternCell->y + $start->y;

            $cell = $grid->getCellAt(new Location($x, $y));

            if ($cell->value() !== $patternCell->value) {
                return null;
            }

            $cells[] = $cell;
        }

        return new Grid(...$cells);
    }
}
