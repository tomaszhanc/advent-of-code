<?php

declare(strict_types=1);

namespace Advent\Year2023\Day10\Model;

use Advent\Shared\Grid\GridCells;
use Advent\Shared\Grid\Search\BreadthFirstSearch;
use Advent\Shared\Grid\Search\ResultEvaluator\FindFarthestPoint;
use Advent\Shared\RuntimeException;

final readonly class Pipes
{
    /** @var Pipe[] */
    private array $pipes;

    public function __construct(Pipe ...$pipes)
    {
        $this->pipes = $pipes;
    }

    public function numberOfStepsToFarthestPoint(): int
    {
        $bfs = new BreadthFirstSearch(new FindFarthestPoint());

        return $bfs->search(
            $this->startingPoint(),
            new GridCells(...$this->pipes)
        )->distance();
    }

    private function startingPoint(): Pipe
    {
        foreach ($this->pipes as $pipe) {
            if ($pipe->isStartingPoint()) {
                return $pipe;
            }
        }

        throw RuntimeException::because("Can't create PipeDiagram because starting point was not found");
    }
}
