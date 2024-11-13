<?php

declare(strict_types=1);

namespace Advent\Year2023\Day7\Model;

interface GameRules
{
    public function cardStrength(Card $card): int;

    public function handStrength(Hand $hand): HandStrength;
}
