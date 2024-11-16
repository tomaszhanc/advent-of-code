<?php

declare(strict_types=1);

namespace Advent\Year2023\Day8\Model;

interface NavigationRules
{
    /** @return Node[] */
    public function startingNodes(Nodes $nodes): iterable;

    public function isFinalDestination(Node $node): bool;
}
