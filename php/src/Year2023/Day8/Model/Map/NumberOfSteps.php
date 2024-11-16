<?php

declare(strict_types=1);

namespace Advent\Year2023\Day8\Model\Map;

use function Advent\Shared\Math\lowestCommonMultiple;

final readonly class NumberOfSteps
{
    private array $numberOfSteps;

    public function __construct(int ...$numberOfSteps)
    {
        $this->numberOfSteps = $numberOfSteps;
    }

    public function toReachAllDestinationSimultaneously(): int
    {
        return lowestCommonMultiple(...$this->numberOfSteps);
    }
}
