<?php

declare(strict_types=1);

namespace Advent\Shared\Graph\Draw;

use Advent\Shared\Graph\Graph;

final readonly class MermaidGraphView
{
    public function generate(Graph $graph): string
    {
        $output = ['graph TD'];
        foreach ($graph->nodes() as $node) {
            $neighbours = $graph->neighboursFor($node);

            foreach ($neighbours as $neighbour) {
                $output[] = sprintf("\t%d --> %d", $node->id(), $neighbour->node->id());
            }
        }

        return implode("\n", $output);
    }
}
