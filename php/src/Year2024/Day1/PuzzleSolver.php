<?php

declare(strict_types=1);

namespace Advent\Year2024\Day1;

use Advent\Shared\Input\Input;
use Advent\Year2024\Day1\Parser\Parser;

final readonly class PuzzleSolver
{
    public function __construct(
        private Parser $parser
    ) {
    }

    public function totalDistanceBetweenTwoLists(Input $input): int
    {
        $twoLists = $this->parser->parse($input);

        return $twoLists->totalDistance();
    }

    public function similarityScore(Input $input): int
    {
        $twoLists = $this->parser->parse($input);

        return $twoLists->similarityScore();
    }
}
