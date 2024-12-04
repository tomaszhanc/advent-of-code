<?php

declare(strict_types=1);

namespace Advent\Year2024\Day4\Parser;

use Advent\Shared\Grid\Location;
use Advent\Shared\Input\Input;
use Advent\Year2024\Day4\Model\Crossword;
use Advent\Year2024\Day4\Model\Square;

final readonly class CrosswordParser
{
    public function parse(Input $input): Crossword
    {
        $squares = [];

        foreach ($input->lines() as $y => $line) {
            foreach (str_split($line) as $x => $char) {
                $squares[] = new Square(
                    new Location($x, $y),
                    $char
                );
            }
        }

        return new Crossword(...$squares);
    }
}
