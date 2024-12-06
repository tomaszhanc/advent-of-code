<?php

declare(strict_types=1);

namespace Advent\Year2024\Day6\Model;

use Advent\Shared\Grid\Grid;

final readonly class Map
{
    private Grid $grid;

    public function __construct(
        public GuardPosition $guardPosition,
        Position ...$positions
    ) {
        $this->grid = new Grid(...$positions);
    }

    public function nextPosition(GuardPosition $currentGuardPosition): ?Position
    {
        $nextLocation = $currentGuardPosition->position->location()->neighbourAt($currentGuardPosition->direction->toGridDirection());

        return $this->grid->findCellAt($nextLocation);
    }
}
