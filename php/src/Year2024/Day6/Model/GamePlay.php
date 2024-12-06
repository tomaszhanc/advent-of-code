<?php

declare(strict_types=1);

namespace Advent\Year2024\Day6\Model;

use Advent\Shared\RuntimeException;
use Advent\Year2024\Day6\Model\Grid\Path;

final readonly class GamePlay
{
    public function escortGuardOutsideTheMap(Map $map): int
    {
        $guardPath = Path::startFrom($map->guardPosition->position);
        $guardPosition = $this->nextGuardPosition($map->guardPosition, $map);

        while ($guardPosition !== null) {
            $guardPath = $guardPath->addStep($guardPosition->position);
            $guardPosition = $this->nextGuardPosition($guardPosition, $map);
        }

        return $guardPath->distinctPositions();
    }

    private function nextGuardPosition(GuardPosition $guardPosition, Map $map): ?GuardPosition
    {
        for ($i = 0; $i < 3; $i++) {
            $position = $map->nextPosition($guardPosition);

            if ($position === null) {
                return null;
            }

            if ($position->isObstacle()) {
                $guardPosition = $guardPosition->rotateRight();
                continue;
            }

            return new GuardPosition($position, $guardPosition->direction);
        }

        throw new RuntimeException('Guard is stuck');
    }
}
