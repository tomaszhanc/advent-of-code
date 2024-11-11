<?php

declare(strict_types=1);

namespace Advent\Year2023\Day6;

use Advent\Shared\Input\Input;
use Advent\Year2023\Day6\Model\Race;
use Advent\Year2023\Day6\Parser\RaceLogParser;

final readonly class RaceEvaluator
{
    public function __construct(
        private RaceLogParser $parser
    ) {
    }

    public function productOfAllNumberOfWaysOfWinning(Input $sheetOfPaper): int
    {
        $raceLog = $this->parser->parse($sheetOfPaper->content());

        return $raceLog->reduce(
            fn (int $product, Race $race): int => $product * $race->waysToWin(),
            initial: 1
        );
    }
}
