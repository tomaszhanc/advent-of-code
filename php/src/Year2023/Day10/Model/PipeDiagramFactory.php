<?php

declare(strict_types=1);

namespace Advent\Year2023\Day10\Model;

use Advent\Shared\Grid\GridCells;
use Advent\Year2023\Day10\Model\Grid\GridCellPipeAdapter;

final readonly class PipeDiagramFactory
{
    public function create(Pipes $pipes): PipeDiagram
    {
        $cells = [];

        foreach ($pipes as $currentPipe) {
            $cells[] = new GridCellPipeAdapter($currentPipe);
        }

        return new PipeDiagram(
            new GridCellPipeAdapter($pipes->startingPoint()),
            new GridCells(...$cells)
        );
    }
}
