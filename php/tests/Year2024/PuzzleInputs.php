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

    public static function day2_unusual_data(): Input
    {
        return FileInput::fromLocal(__DIR__ . '/../../resources/2024/day2.txt');
    }

    public static function day3_program_memory(): Input
    {
        return FileInput::fromLocal(__DIR__ . '/../../resources/2024/day3.txt');
    }

    public static function day4_crossword(): Input
    {
        return FileInput::fromLocal(__DIR__ . '/../../resources/2024/day4.txt');
    }

    public static function day5_page_updates(): Input
    {
        return FileInput::fromLocal(__DIR__ . '/../../resources/2024/day5.txt');
    }
}
