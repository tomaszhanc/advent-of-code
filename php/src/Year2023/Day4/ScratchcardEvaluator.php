<?php

declare(strict_types=1);

namespace Advent\Year2023\Day4;

use Advent\Shared\Filesystem\File;
use Advent\Year2023\Day4\Parser\ScratchcardParser;

final readonly class ScratchcardEvaluator
{
    public function __construct(
        private ScratchcardParser $parser
    ) {
    }

    public function sumAllPoints(File $scratchcardsRecord): int
    {
        $sum = 0;

        foreach ($scratchcardsRecord->lines() as $unparsedLine) {
            $sum += $this->parser
                ->parse($unparsedLine)
                ->points();
        }

        return $sum;
    }
}
