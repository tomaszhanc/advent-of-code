<?php

declare(strict_types=1);

namespace Advent\Year2023\Day3;

use Advent\Shared\Input\Input;
use Advent\Shared\Iterator\LookaroundIterator;
use Advent\Year2023\Day3\Model\Element\Elements;
use Advent\Year2023\Day3\Model\GearsFactory;
use Advent\Year2023\Day3\Model\PartNumbersFactory;
use Advent\Year2023\Day3\Parser\EngineSchematicParser;

final readonly class PuzzleSolver
{
    public function __construct(
        private EngineSchematicParser $parser,
        private PartNumbersFactory $partNumbersFactory,
        private GearsFactory $gearsFactory
    ) {
    }

    public function sumAllPartNumbers(Input $engineSchematic): int
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

    public function sumAllGearRatios(Input $engineSchematic): int
    {
        $sum = 0;
        $iterator = new LookaroundIterator($engineSchematic->lines());

        while ($iterator->valid()) {
            $lineNumber = $iterator->key();

            $aboveElements = $this->parser->parse($lineNumber - 1, $iterator->lookbehind());
            $currentElements = $this->parser->parse($lineNumber, $iterator->current());
            $belowElements = $this->parser->parse($lineNumber + 1, $iterator->lookahead());

            $sum += $this->gearsFactory->createFor(new Elements(
                ...$currentElements->numberElements(),
                ...$currentElements->symbolElements(),
                ...$aboveElements->numberElements(),
                ...$belowElements->numberElements()
            ))->sumGearRatios();

            $iterator->next();
        }

        return $sum;
    }
}
