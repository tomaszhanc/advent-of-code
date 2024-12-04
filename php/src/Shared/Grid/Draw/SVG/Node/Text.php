<?php

declare(strict_types=1);

namespace Advent\Shared\Grid\Draw\SVG\Node;

use Advent\Shared\Grid\Draw\SVG\Node;
use Advent\Shared\Grid\Location;
use SVG\Nodes\SVGNode;
use SVG\Nodes\Texts\SVGText;

final readonly class Text implements Node
{
    public function __construct(
        private Location $location,
        private string $text
    ) {
    }

    public function toSVGNode(int $size): SVGNode
    {
        $multiplier = 0.8;

        $text = new SVGText(
            $this->text,
            $this->location->x * $size + $size * (1 - $multiplier),
            ($this->location->y) * $size + $size * $multiplier
        );
        $text->setStyle('fill', 'black');
        $text->setStyle('font-family', 'Arial');
        $text->setStyle('justify-content', 'center');
        $text->setFontSize($size * $multiplier);

        return $text;
    }
}
