<?php

declare(strict_types=1);

namespace Advent\Year2024\Day6\Parser;

use Advent\Shared\Grid\Location;
use Advent\Shared\Input\Input;
use Advent\Year2024\Day6\Model\Direction;
use Advent\Year2024\Day6\Model\GuardPosition;
use Advent\Year2024\Day6\Model\Map;
use Advent\Year2024\Day6\Model\Position;

final readonly class MapParser
{
    public function parse(Input $input): Map
    {
        $guardPosition = null;
        $positions = [];

        foreach (explode("\n", $input->content()) as $y => $row) {
            foreach (str_split($row) as $x => $char) {
                if ($char === '^') {
                    $positions[] = new Position(new Location($x, $y), '.');
                    $guardPosition = new GuardPosition(
                        new Position(new Location($x, $y), '.'),
                        Direction::from($char)
                    );
                    continue;
                }

                $positions[] = new Position(new Location($x, $y), $char);
            }
        }

        return new Map($guardPosition, ...$positions);
    }
}
