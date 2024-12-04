<?php

declare(strict_types=1);

namespace Advent\Year2024\Day4\Model;

use Advent\Shared\Grid\Grid;

final readonly class Crossword
{
    /** @var Square[] */
    private array $squares;

    public function __construct(Square ...$squares)
    {
        $this->squares = $squares;
    }

    public function numberOfOccurrences(string $key): int
    {
        $grid = new Grid(...$this->squares);
        $result = 0;
        ;

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

    public function crosswordLineToString(Square ...$squares): string
    {
        return implode('', array_map(fn (Square $square) => $square->value, $squares));
    }
}
