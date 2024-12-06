<?php

declare(strict_types=1);

namespace Advent\Year2024\Day6;

use Advent\Shared\Input\Input;
use Advent\Year2024\Day6\Model\GamePlay;
use Advent\Year2024\Day6\Parser\MapParser;

final readonly class PuzzleSolver
{
    public function __construct(
        private MapParser $parser,
        private GamePlay $gamePlay
    ) {
    }

    public function numberOfPositionsVisitedByGuard(Input $input): int
    {
        $map = $this->parser->parse($input);

        return $this->gamePlay->escortGuardOutsideTheMap($map);
    }
}
