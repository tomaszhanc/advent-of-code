<?php

declare(strict_types=1);

namespace Advent\Year2023\Day8;

use Advent\Shared\Input\Input;
use Advent\Year2023\Day8\Model\NavigationRules\FromAllNodesEndWithAToNodesEndWithZ;
use Advent\Year2023\Day8\Model\NavigationRules\FromNodeAAAToNodeZZZ;
use Advent\Year2023\Day8\Parser\Parser;

final readonly class PuzzleSolver
{
    public function __construct(
        private Parser $parser
    ) {
    }

    public function numberOfStepsFromAAAToZZZ(Input $file): int
    {
        $map = $this->parser->parse($file->content());

        return $map->numberOfSteps(new FromNodeAAAToNodeZZZ());
    }

    public function numberOfStepsFromAllStartingPositions(Input $file): int
    {
        $map = $this->parser->parse($file->content());

        return $map->numberOfSteps(new FromAllNodesEndWithAToNodesEndWithZ());
    }
}
