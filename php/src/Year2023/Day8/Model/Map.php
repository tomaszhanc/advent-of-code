<?php

declare(strict_types=1);

namespace Advent\Year2023\Day8\Model;

final readonly class Map
{
    public function __construct(
        private Instructions $instructions,
        private Nodes $nodes
    ) {
    }

    public function numberOfStepsToReachFinalDestination(): int
    {
        $currentNode = $this->nodes->startNode();
        $numberOfSteps = 0;

        foreach ($this->instructions as $nextStep) {
            $currentNode = $this->nodes->moveFrom($currentNode, $nextStep);
            $numberOfSteps++;

            if ($currentNode->isFinalDestination()) {
                return $numberOfSteps;
            }
        }
    }
}
