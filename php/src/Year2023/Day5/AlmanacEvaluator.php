<?php

declare(strict_types=1);

namespace Advent\Year2023\Day5;

use Advent\Shared\Filesystem\File;
use Advent\Year2023\Day5\Parser\AlmanacParser;

final readonly class AlmanacEvaluator
{
    public function __construct(
        private AlmanacParser $parser
    ) {
    }

    public function lowestLocationNumber(File $almanac): int
    {
        $almanac = $this->parser->parse($almanac->content());

        return $almanac->lowestLocationNumber();
    }

    public function lowestLocationNumberWithSeedRanges(File $almanac): int
    {
        $almanac = $this->parser->parse($almanac->content());

        return $almanac->lowestLocationNumberWithSeedRanges();
    }
}
