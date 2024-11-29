<?php

declare(strict_types=1);

namespace Advent\Year2023\Day10;

use Advent\Shared\Input\Input;
use Advent\Year2023\Day10\Model\PipeDiagramFactory;
use Advent\Year2023\Day10\Parser\PipeParser;

final readonly class PuzzleSolver
{
    public function __construct(
        private PipeParser $parser,
        private PipeDiagramFactory $factory
    ) {
    }

    public function numberOfStepsToFurthestPositionFromStartingPoint(Input $input): int
    {
        $pipes = $this->parser->parse($input);
        $pipeDiagram = $this->factory->create($pipes);

        return $pipeDiagram->stepsToFarthestPoint();
    }
}
