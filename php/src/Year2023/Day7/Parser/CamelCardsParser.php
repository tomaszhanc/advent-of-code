<?php

declare(strict_types=1);

namespace Advent\Year2023\Day7\Parser;

use Advent\Shared\Input\Input;
use Advent\Year2023\Day7\Model\Hand;
use Advent\Year2023\Day7\Model\Hands;

final readonly class CamelCardsParser
{
    public function __construct()
    {
    }

    public function parse(string $line): Hand
    {
        [$hand, $bid] = explode(' ', $line);

        return Hand::of($hand, (int) $bid);
    }

    public function parseAll(Input $input): Hands
    {
        $hands = [];

        foreach ($input->lines() as $line) {
            $hands[] = $this->parse($line);
        }

        return new Hands(...$hands);
    }
}
