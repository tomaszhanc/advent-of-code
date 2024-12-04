<?php

declare(strict_types=1);

namespace Advent\Shared\Grid\Draw\SVG\Node;

use Advent\Shared\Grid\Draw\SVG\Node;
use Advent\Shared\Grid\Location;
use SVG\Nodes\Shapes\SVGRect;
use SVG\Nodes\SVGNode;

final readonly class Rectangle implements Node
{
    public function __construct(
        private Location $location
    ) {
    }

    public function toSVGNode(int $size): SVGNode
    {
        return new SVGRect(
            $this->location->x * $size,
            $this->location->y * $size,
            $size,
            $size
        );
    }
}
