<?php

declare(strict_types=1);

namespace Advent\Year2023\Day8\Model\NavigationRules;

use Advent\Year2023\Day8\Model\NavigationRules;
use Advent\Year2023\Day8\Model\Node;
use Advent\Year2023\Day8\Model\Nodes;

final readonly class FromAllNodesEndWithAToNodesEndWithZ implements NavigationRules
{
    public function startingNodes(Nodes $nodes): iterable
    {
        return $nodes->filter(fn (Node $node): bool => $node->endsWithA());
    }

    public function isFinalDestination(Node $node): bool
    {
        return $node->endsWithZ();
    }
}
