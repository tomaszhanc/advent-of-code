<?php

declare(strict_types=1);

namespace Advent\Shared\Grid\Draw\SVG;

use SVG\Nodes\SVGNode;

interface Node
{
    public function toSVGNode(int $size): SVGNode;
}
