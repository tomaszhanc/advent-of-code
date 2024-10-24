<?php

declare(strict_types=1);

namespace Advent\Year2023\Day3;

use Advent\Shared\Filesystem\File;
use Advent\Shared\Iterator\LookaroundIterator;
use Advent\Year2023\Day3\Model\Element\Elements;
use Advent\Year2023\Day3\Model\PartNumbersFactory;
use Advent\Year2023\Day3\Parser\EngineSchematicParser;

final readonly class PartNumbersEvaluator
{
    public function __construct(
        private EngineSchematicParser $parser,
        private PartNumbersFactory $partNumbersFactory,
    ) {
    }

    public function sumAllPartNumbers(File $engineSchematic): int
    {
        $sum = 0;
        $iterator = new LookaroundIterator($engineSchematic->lines());

        while ($iterator->valid()) {
            $lineNumber = $iterator->key();

            $aboveElements = $this->parser->parse($lineNumber - 1, $iterator->lookbehind());
            $currentElements = $this->parser->parse($lineNumber, $iterator->current());
            $belowElements = $this->parser->parse($lineNumber + 1, $iterator->lookahead());

            $sum += $this->partNumbersFactory->createFor(new Elements(
                ...$currentElements->numberElements(),
                ...$currentElements->symbolElements(),
                ...$aboveElements->symbolElements(),
                ...$belowElements->symbolElements()
            ))->sum();

            $iterator->next();
        }

        return $sum;
    }
}
