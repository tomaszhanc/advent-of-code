<?php

declare(strict_types=1);

namespace Advent\Tests\Shared\Mother\Grid;

use Advent\Shared\Grid\Position\ColumnPosition;
use Advent\Shared\Grid\Position\RowPosition;
use Advent\Shared\Grid\RelativePosition;

final readonly class PositionMother
{
    public static function detached(): RelativePosition
    {
        return new RelativePosition(ColumnPosition::DETACHED, RowPosition::DETACHED);
    }

    public static function detachedAbove(): RelativePosition
    {
        return new RelativePosition(ColumnPosition::DETACHED, RowPosition::ABOVE);
    }

    public static function detachedColumn(): RelativePosition
    {
        return new RelativePosition(ColumnPosition::DETACHED, RowPosition::SAME);
    }

    public static function detachedRow(): RelativePosition
    {
        return new RelativePosition(ColumnPosition::SAME, RowPosition::DETACHED);
    }

    public static function detachedBelow(): RelativePosition
    {
        return new RelativePosition(ColumnPosition::DETACHED, RowPosition::BELOW);
    }

    public static function leftAbove(): RelativePosition
    {
        return new RelativePosition(ColumnPosition::LEFT, RowPosition::ABOVE);
    }

    public static function left(): RelativePosition
    {
        return new RelativePosition(ColumnPosition::LEFT, RowPosition::SAME);
    }

    public static function leftBelow(): RelativePosition
    {
        return new RelativePosition(ColumnPosition::LEFT, RowPosition::BELOW);
    }

    public static function leftDetached(): RelativePosition
    {
        return new RelativePosition(ColumnPosition::LEFT, RowPosition::DETACHED);
    }

    public static function above(): RelativePosition
    {
        return new RelativePosition(ColumnPosition::SAME, RowPosition::ABOVE);
    }

    public static function same(): RelativePosition
    {
        return new RelativePosition(ColumnPosition::SAME, RowPosition::SAME);
    }

    public static function below(): RelativePosition
    {
        return new RelativePosition(ColumnPosition::SAME, RowPosition::BELOW);
    }

    public static function rightAbove(): RelativePosition
    {
        return new RelativePosition(ColumnPosition::RIGHT, RowPosition::ABOVE);
    }

    public static function right(): RelativePosition
    {
        return new RelativePosition(ColumnPosition::RIGHT, RowPosition::SAME);
    }

    public static function rightBelow(): RelativePosition
    {
        return new RelativePosition(ColumnPosition::RIGHT, RowPosition::BELOW);
    }

    public static function rightDetached(): RelativePosition
    {
        return new RelativePosition(ColumnPosition::RIGHT, RowPosition::DETACHED);
    }
}
