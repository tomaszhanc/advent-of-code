<?php

declare(strict_types=1);

namespace Advent\Year2024\Day4;

use Advent\Shared\Input\Input;
use Advent\Year2024\Day4\Parser\CrosswordParser;

final readonly class PuzzleSolver
{
    public function __construct(
        private CrosswordParser $parser
    ) {
    }

    public function numberOfOccurrences(string $key, Input $input): int
    {
        $crossword = $this->parser->parse($input);

        return $crossword->numberOfOccurrences($key);
    }
}
