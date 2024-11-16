<?php

declare(strict_types=1);

namespace Advent\Year2023\Day8\Model\NavigationRules;

use Advent\Year2023\Day8\Model\NavigationRules;
use Advent\Year2023\Day8\Model\Node;
use Advent\Year2023\Day8\Model\Nodes;

final readonly class FromNodeAAAToNodeZZZ implements NavigationRules
{
    public function startingNodes(Nodes $nodes): iterable
    {
        yield $nodes->get('AAA');
    }

    public function isFinalDestination(Node $node): bool
    {
        return $node->is('ZZZ');
    }
}
