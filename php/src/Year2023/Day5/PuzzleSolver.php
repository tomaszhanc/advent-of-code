<?php

declare(strict_types=1);

namespace Advent\Year2023\Day5;

use Advent\Shared\Input\Input;
use Advent\Year2023\Day5\Parser\AlmanacParser;

final readonly class AlmanacEvaluator
{
    public function __construct(
        private AlmanacParser $parser
    ) {
    }

    public function lowestLocationNumber(Input $almanac): int
    {
        $almanac = $this->parser->parse($almanac->content());

        return $almanac->lowestLocationNumber();
    }

    public function lowestLocationNumberWithSeedRanges(Input $almanac): int
    {
        $almanac = $this->parser->parse($almanac->content());

        return $almanac->lowestLocationNumberWithSeedRanges();
    }
}
