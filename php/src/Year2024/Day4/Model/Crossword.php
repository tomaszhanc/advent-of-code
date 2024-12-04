<?php

declare(strict_types=1);

namespace Advent\Year2024\Day4\Model;

use Advent\Shared\Grid\Grid;
use Advent\Shared\Grid\Pattern\PatternMatcher;

final readonly class Crossword
{
    /** @var Square[] */
    public array $squares;

    public function __construct(Square ...$squares)
    {
        $this->squares = $squares;
    }

    public function numberOfOccurrences(string $key): int
    {
        $result = 0;

        $grid = new Grid(...$this->squares);
        $crosswordLines = [
            ...$grid->allRows(),
            ...$grid->allColumns(),
            ...$grid->allDiagonals(),
        ];

        foreach ($crosswordLines as $crosswordLine) {
            $line = $this->crosswordLineToString(...$crosswordLine);
            $result += substr_count($line, $key);
            $result += substr_count($line, strrev($key));
        }

        return $result;
    }

    public function numberOfOccurrences2(): int
    {
        $result = 0;

        $grid = new Grid(...$this->squares);
        $patterns = [
            Grid::fromPattern([
                ['M', '.', 'M'],
                ['.', 'A', '.'],
                ['S', '.', 'S'],
            ]),
            Grid::fromPattern([
                ['M', '.', 'S'],
                ['.', 'A', '.'],
                ['M', '.', 'S'],
            ]),
            Grid::fromPattern([
                ['S', '.', 'M'],
                ['.', 'A', '.'],
                ['S', '.', 'M'],
            ]),
            Grid::fromPattern([
                ['S', '.', 'S'],
                ['.', 'A', '.'],
                ['M', '.', 'M'],
            ]),
        ];

        foreach ($patterns as $pattern) {
            $patternMatcher = new PatternMatcher($pattern);

            // fixme moge sprawdzic match w metodzie subGrid, wtedy nie musze tworzyc calego grida
            // i klonowac cells
            foreach ($grid->subGrids(3, 3) as $subGrid) {
                if ($patternMatcher->matchedBy($subGrid)) {
                    $result++;
                }
            }
        }

        return $result;
    }

    private function crosswordLineToString(Square ...$squares): string
    {
        return implode('', array_map(fn (Square $square) => $square->letter, $squares));
    }
}
