<?php

declare(strict_types=1);

namespace Advent\Year2024\Day4\Parser;

use Advent\Shared\Grid\Cell\StringCell;
use Advent\Shared\Input\Input;
use Advent\Year2024\Day4\Model\Crossword;

final readonly class CrosswordParser
{
    public function parse(Input $input): Crossword
    {
        $squares = [];

        foreach ($input->lines() as $y => $line) {
            foreach (str_split($line) as $x => $char) {
                if ($char === PHP_EOL) {
                    continue;
                }

                $squares[] = new StringCell($x, $y, $char);
            }
        }

        return new Crossword(...$squares);
    }
}
