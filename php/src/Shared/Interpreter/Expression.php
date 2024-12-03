<?php

declare(strict_types=1);

namespace Advent\Shared\Interpreter;

interface Expression
{
    public function interpret(): int;
}
