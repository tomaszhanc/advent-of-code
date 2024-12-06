<?php

declare(strict_types=1);

namespace Advent\Year2024\Day4\Model;

use Advent\Shared\Grid\Cell\StringCell;
use Advent\Shared\Grid\Grid;
use Advent\Shared\Grid\PatternMatching\Pattern;
use Advent\Shared\Grid\PatternMatching\PatternMatcher;

final readonly class Crossword
{
    /** @var StringCell[] */
    public array $cells;

    public function __construct(StringCell ...$cells)
    {
        $this->cells = $cells;
    }

    public function numberOfOccurrences(string $key): int
    {
        $result = 0;

        $grid = new Grid(...$this->cells);
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

    public function xmasPatternOccurrences(): int
    {
        $patternMatcher = new PatternMatcher(
            Pattern::fromArray([
                ['M', '.', 'M'],
                ['.', 'A', '.'],
                ['S', '.', 'S'],
            ]),
            Pattern::fromArray([
                ['M', '.', 'S'],
                ['.', 'A', '.'],
                ['M', '.', 'S'],
            ]),
            Pattern::fromArray([
                ['S', '.', 'M'],
                ['.', 'A', '.'],
                ['S', '.', 'M'],
            ]),
            Pattern::fromArray([
                ['S', '.', 'S'],
                ['.', 'A', '.'],
                ['M', '.', 'M'],
            ])
        );

        $matchedSubGrids = $patternMatcher->matchIn(new Grid(...$this->cells));

        return count(iterator_to_array($matchedSubGrids));
    }

    private function crosswordLineToString(StringCell ...$squares): string
    {
        return implode('', array_map(fn (StringCell $square) => $square->value(), $squares));
    }
}
