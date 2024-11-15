<?php

declare(strict_types=1);

namespace Advent\Year2023\Day8;

use Advent\Shared\Input\Input;
use Advent\Year2023\Day8\Parser\Parser;

final readonly class PuzzleSolver
{
    public function __construct(
        private Parser $parser
    ) {
    }

    public function numberOfSteps(Input $file): int
    {
        $map = $this->parser->parse($file->content());

        return $map->numberOfStepsToReachFinalDestination();
    }
}
