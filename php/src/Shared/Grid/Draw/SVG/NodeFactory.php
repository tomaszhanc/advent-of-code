<?php

declare(strict_types=1);

namespace Advent\Shared\Grid\Draw\SVG;

use Advent\Shared\Grid\Draw\SVG\Node\Path;
use Advent\Shared\Grid\Draw\SVG\Node\Path\Half\DownHalfPartialPath;
use Advent\Shared\Grid\Draw\SVG\Node\Path\Half\LeftHalfPartialPath;
use Advent\Shared\Grid\Draw\SVG\Node\Path\Half\MidPointA;
use Advent\Shared\Grid\Draw\SVG\Node\Path\Half\MidPointB;
use Advent\Shared\Grid\Draw\SVG\Node\Path\Half\MidPointC;
use Advent\Shared\Grid\Draw\SVG\Node\Path\Half\MidPointD;
use Advent\Shared\Grid\Draw\SVG\Node\Path\Half\RightHalfPartialPath;
use Advent\Shared\Grid\Draw\SVG\Node\Path\Half\UpHalfPartialPath;
use Advent\Shared\Grid\Draw\SVG\Node\Rectangle;
use Advent\Shared\Grid\Location;

final readonly class NodeFactory
{
    public static function create(Location $location, NodeType $pathType): Node
    {
        return match ($pathType) {
            NodeType::RECTANGLE => new Rectangle($location),

            NodeType::LINE_UP_DOWN => self::upDownPath($location),
            NodeType::LINE_UP_RIGHT => self::upRightPath($location),
            NodeType::LINE_UP_LEFT => self::upLeftPath($location),
            NodeType::LINE_LEFT_RIGHT => self::leftRightPath($location),
            NodeType::LINE_DOWN_RIGHT => self::downRightPath($location),
            NodeType::LINE_DOWN_LEFT => self::downLeftPath($location),
        };
    }

    private static function upDownPath(Location $location): Node
    {
        return new Path(
            new UpHalfPartialPath($location),
            new DownHalfPartialPath($location)
        );
    }

    private static function upRightPath(Location $location): Node
    {
        return new Path(
            new UpHalfPartialPath($location),
            new MidPointB($location),
            new RightHalfPartialPath($location),
            new MidPointD($location)
        );
    }

    private static function upLeftPath(Location $location): Node
    {
        return new Path(
            new UpHalfPartialPath($location),
            new MidPointC($location),
            new LeftHalfPartialPath($location),
            new MidPointA($location)
        );
    }

    private static function leftRightPath(Location $location): Node
    {
        return new Path(
            new LeftHalfPartialPath($location),
            new RightHalfPartialPath($location)
        );
    }

    private static function downRightPath(Location $location): Node
    {
        return new Path(
            new DownHalfPartialPath($location),
            new MidPointA($location),
            new RightHalfPartialPath($location),
            new MidPointC($location)
        );
    }

    private static function downLeftPath(Location $location): Node
    {
        return new Path(
            new DownHalfPartialPath($location),
            new MidPointD($location),
            new LeftHalfPartialPath($location),
            new MidPointB($location)
        );
    }
}
