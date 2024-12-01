<?php

declare(strict_types=1);

namespace Advent\Tests\Year2024;

use Advent\Shared\Input\Input;
use Advent\Shared\Input\FileInput;

final readonly class PuzzleInputs
{
    public static function day1_list(): Input
    {
        return FileInput::fromLocal(__DIR__ . '/../../resources/2024/day1.txt');
    }
}
