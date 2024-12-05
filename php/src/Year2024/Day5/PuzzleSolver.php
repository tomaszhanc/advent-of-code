<?php

declare(strict_types=1);

namespace Advent\Year2024\Day5;

use Advent\Shared\Input\Input;
use Advent\Year2024\Day5\Parser\PageOrderingRulesParser;

final readonly class PuzzleSolver
{
    public function __construct(
        private PageOrderingRulesParser $parser
    ) {
    }

    public function sumOfMiddleNumbersOfUpdatesInRightOrder(Input $input): int
    {
        [$priorityList, $pageUpdates] = $this->parser->parse($input);

        return $pageUpdates->sumOfMiddleNumbersOfUpdatesInRightOrder($priorityList);
    }

    public function sumOfMiddleNumbersOfCorrectedUpdates(Input $input): int
    {
        [$priorityList, $pageUpdates] = $this->parser->parse($input);

        return $pageUpdates->sumOfMiddleNumbersOfCorrectedUpdates($priorityList);
    }
}
