<?php

declare(strict_types=1);

namespace Advent\Shared\Grid\Draw\SVG\Node\Path\Half;

use Advent\Shared\Grid\Draw\SVG\Node\Path\PartialPath;
use Advent\Shared\Grid\Location;

final readonly class RightHalfPartialPath implements PartialPath
{
    public function __construct(
        private Location $location
    ) {
    }

    /** @return Location[] */
    public function scaleTo(int $size): array
    {
        return [
            Location::roundUp(
                ($this->location->x + 1)   * $size,
                ($this->location->y + 0.5) * $size - 1
            ),
            Location::roundUp(
                ($this->location->x + 1)   * $size,
                ($this->location->y + 0.5) * $size + 1
            ),
        ];
    }
}
