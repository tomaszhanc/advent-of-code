<?php

declare(strict_types=1);

namespace Advent\Year2023\Day10\Model;

use Advent\Shared\Graph\Search\BreadthFirstSearch;
use Advent\Shared\Graph\Search\DeepFirstSearch;
use Advent\Shared\Graph\Search\Path;
use Advent\Shared\Graph\Search\ResultEvaluator\FindFarthestPoint;
use Advent\Shared\Grid\GraphBridge\GridCellNode;
use Advent\Shared\Grid\GraphBridge\GridToGraphFactory;
use Advent\Shared\Grid\Grid;
use Advent\Shared\RuntimeException;
use Advent\Year2023\Day10\Model\Grid\PipeAllowedDirections;
use Traversable;

final readonly class Pipes implements \IteratorAggregate
{
    /** @var Pipe[] */
    private array $pipes;

    public function __construct(Pipe ...$pipes)
    {
        $this->pipes = $pipes;
    }

    public function longestPath(): Path
    {
        $dfs = new DeepFirstSearch();

        return $dfs->search(
            new GridCellNode($this->startingPoint()),
            new GridToGraphFactory(new PipeAllowedDirections())->createGraph(new Grid(...$this->pipes)),
            new FindFarthestPoint()
        )->path();
    }

    public function numberOfStepsToFarthestPoint(): int
    {
        $bfs = new BreadthFirstSearch();

        return $bfs->search(
            new GridCellNode($this->startingPoint()),
            new GridToGraphFactory(new PipeAllowedDirections())->createGraph(new Grid(...$this->pipes)),
            new FindFarthestPoint()
        )->path()->distance();
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

    /**
     * @return Traversable<Pipe>
     */
    public function getIterator(): Traversable
    {
        return new \ArrayIterator($this->pipes);
    }
}
