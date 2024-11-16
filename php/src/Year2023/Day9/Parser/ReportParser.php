<?php

declare(strict_types=1);

namespace Advent\Year2023\Day9\Parser;

use Advent\Year2023\Day9\Model\Sequence;

final readonly class ReportParser
{
    public function parse(string $line): Sequence
    {
        return new Sequence(...array_map('intval', explode(' ', $line)));
    }
}
