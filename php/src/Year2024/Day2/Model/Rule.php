<?php
declare(strict_types=1);

namespace Advent\Year2024\Day2\Model;

interface Rule
{
    public function isSatisfied(int $current, int $next) : bool;
}