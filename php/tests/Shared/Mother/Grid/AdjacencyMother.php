<?php

declare(strict_types=1);

namespace Advent\Tests\Shared\Mother\Grid;

use Advent\Shared\Grid\Adjacency\ColumnAdjacency;
use Advent\Shared\Grid\Adjacency\RowAdjacency;
use Advent\Shared\Grid\Adjacency;

final readonly class AdjacencyMother
{
    public static function distant(): Adjacency
    {
        return new Adjacency(ColumnAdjacency::DISTANT, RowAdjacency::DISTANT);
    }

    public static function distantColumnAndAboveRow(): Adjacency
    {
        return new Adjacency(ColumnAdjacency::DISTANT, RowAdjacency::ABOVE);
    }

    public static function distantColumnAndSameRow(): Adjacency
    {
        return new Adjacency(ColumnAdjacency::DISTANT, RowAdjacency::SAME);
    }

    public static function distantColumnAndBelowRow(): Adjacency
    {
        return new Adjacency(ColumnAdjacency::DISTANT, RowAdjacency::BELOW);
    }

    public static function leftColumnAndDistantRow(): Adjacency
    {
        return new Adjacency(ColumnAdjacency::LEFT, RowAdjacency::DISTANT);
    }

    public static function leftColumnAndAboveRow(): Adjacency
    {
        return new Adjacency(ColumnAdjacency::LEFT, RowAdjacency::ABOVE);
    }

    public static function leftColumnAndSameRow(): Adjacency
    {
        return new Adjacency(ColumnAdjacency::LEFT, RowAdjacency::SAME);
    }

    public static function leftColumnAndBelowRow(): Adjacency
    {
        return new Adjacency(ColumnAdjacency::LEFT, RowAdjacency::BELOW);
    }

    public static function sameColumnAndDistantRow(): Adjacency
    {
        return new Adjacency(ColumnAdjacency::SAME, RowAdjacency::DISTANT);
    }

    public static function sameColumnAndAboveRow(): Adjacency
    {
        return new Adjacency(ColumnAdjacency::SAME, RowAdjacency::ABOVE);
    }

    public static function same(): Adjacency
    {
        return new Adjacency(ColumnAdjacency::SAME, RowAdjacency::SAME);
    }

    public static function sameColumnAndBelowRow(): Adjacency
    {
        return new Adjacency(ColumnAdjacency::SAME, RowAdjacency::BELOW);
    }

    public static function rightColumnAndDistantRow(): Adjacency
    {
        return new Adjacency(ColumnAdjacency::RIGHT, RowAdjacency::DISTANT);
    }

    public static function rightColumnAndAboveRow(): Adjacency
    {
        return new Adjacency(ColumnAdjacency::RIGHT, RowAdjacency::ABOVE);
    }

    public static function rightColumnAndSameRow(): Adjacency
    {
        return new Adjacency(ColumnAdjacency::RIGHT, RowAdjacency::SAME);
    }

    public static function rightColumnAndBelowRow(): Adjacency
    {
        return new Adjacency(ColumnAdjacency::RIGHT, RowAdjacency::BELOW);
    }
}
