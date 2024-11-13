<?php

declare(strict_types=1);

namespace Advent\Year2023\Day7;

use Advent\Shared\Input\Input;
use Advent\Year2023\Day7\Model\GameRules\JokerInPlay;
use Advent\Year2023\Day7\Model\GameRules\StandardRules;
use Advent\Year2023\Day7\Parser\CamelCardsParser;

final readonly class PuzzleSolver
{
    public function __construct(
        private CamelCardsParser $parser
    ) {
    }

    public function totalWinningsFor(Input $file): int
    {
        $hands = $this->parser->parseAll($file);

        return $hands->totalWinnings(new StandardRules());
    }

    public function totalWinningsWithJokersFor(Input $file): int
    {
        $hands = $this->parser->parseAll($file);

        return $hands->totalWinnings(new JokerInPlay());
    }
}
