<?php

declare(strict_types=1);

namespace Advent\Year2023\Day8\Model;

use Advent\Year2023\Day8\Model\Map\NumberOfSteps;

final readonly class Map
{
    public function __construct(
        private Instructions $instructions,
        private Nodes $nodes
    ) {
    }

    public function numberOfSteps(NavigationRules $rules): int
    {
        $allNumberOfSteps = [];

        foreach ($rules->startingNodes($this->nodes) as $currentNode) {
            $numberOfSteps = 0;

            foreach ($this->instructions as $nextStep) {
                $currentNode = $currentNode->move($nextStep, $this->nodes);
                $numberOfSteps++;

                if ($rules->isFinalDestination($currentNode)) {
                    $allNumberOfSteps[] = $numberOfSteps;
                    break;
                }
            }
        }

        return (new NumberOfSteps(...$allNumberOfSteps))->toReachAllDestinationSimultaneously();
    }
}
