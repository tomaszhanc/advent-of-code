<?php

declare(strict_types=1);

namespace Advent\Shared\Grid\Draw\SVG\Node;

use Advent\Shared\Grid\Draw\SVG\Node;
use Advent\Shared\Grid\Draw\SVG\Node\Path\PartialPath;
use SVG\Nodes\Shapes\SVGPath;
use SVG\Nodes\SVGNode;

final readonly class Path implements Node
{
    /** @var PartialPath[] */
    private array $partialPaths;

    public function __construct(PartialPath ...$partialPaths)
    {
        $this->partialPaths = $partialPaths;
    }

    public function toSVGNode(int $size): SVGNode
    {
        $locations = $this->scaleAllPartialPathTo($size);

        $first = array_shift($locations);
        $d = [];

        $d[] = sprintf("M%d %d", $first->x, $first->y);
        foreach ($locations as $point) {
            $d[] = sprintf("L%d %d", $point->x, $point->y);
        }
        $d[] = "Z";

        return new SVGPath(implode(' ', $d));
    }

    private function scaleAllPartialPathTo(int $size): array
    {
        return array_merge(...array_map(
            fn (PartialPath $partialPath) => $partialPath->scaleTo($size),
            $this->partialPaths
        ));
    }
}
