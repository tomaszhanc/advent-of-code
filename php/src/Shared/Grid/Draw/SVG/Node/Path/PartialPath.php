<?php

declare(strict_types=1);

namespace Advent\Shared\Grid\Draw\SVG\Node\Path;

use Advent\Shared\Grid\Location;

interface PartialPath
{
    /** @return Location[] */
    public function scaleTo(int $size): array;
}
