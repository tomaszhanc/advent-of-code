<?php

declare(strict_types=1);

namespace Advent\Year2023\Day10\Model;

use Advent\Shared\RuntimeException;
use Traversable;

final readonly class Pipes implements \IteratorAggregate
{
    /** @var Pipe[] */
    private array $pipes;

    public function __construct(Pipe ...$pipes)
    {
        $this->pipes = $pipes;
    }

    public function startingPoint(): Pipe
    {
        foreach ($this->pipes as $pipe) {
            if ($pipe->isStartingPoint()) {
                return $pipe;
            }
        }

        throw RuntimeException::because("Can't create PipeDiagram because starting point was not found");
    }

    /** @return Traversable<Pipe> */
    public function getIterator(): Traversable
    {
        return new \ArrayIterator($this->pipes);
    }
}
