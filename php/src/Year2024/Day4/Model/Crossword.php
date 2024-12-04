<?php

declare(strict_types=1);

namespace Advent\Year2024\Day4\Model;

use Advent\Shared\Grid\Grid;
use Advent\Shared\Grid\Pattern;
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

    public function xmasPatternOccurences(): int
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

        $matchedSubGrids = $patternMatcher->matchIn(new Grid(...$this->squares));

        return count(iterator_to_array($matchedSubGrids));
    }

    private function crosswordLineToString(Square ...$squares): string
    {
        return implode('', array_map(fn (Square $square) => $square->letter, $squares));
    }
}
