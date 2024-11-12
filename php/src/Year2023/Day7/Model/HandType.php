<?php

declare(strict_types=1);

namespace Advent\Year2023\Day7\Model;

enum HandType: int
{
    case FIVE_OF_A_KIND = 7;
    case FOUR_OF_A_KIND = 6;
    case FULL_HOUSE = 5;
    case THREE_OF_A_KIND = 4;
    case TWO_PAIR = 3;
    case ONE_PAIR = 2;
    case HIGH_CARD = 1;

    public function strength() : int
    {
        return $this->value;
    }
}
