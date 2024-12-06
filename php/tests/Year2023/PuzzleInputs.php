<?php

declare(strict_types=1);

namespace Advent\Tests\Year2023;

use Advent\Shared\Input\Input;
use Advent\Shared\Input\FileInput;

final readonly class PuzzleInputs
{
    public static function day1_calibrationDocument(): Input
    {
        return FileInput::fromLocal(__DIR__ . '/../../../resources/2023/day1.txt');
    }

    public static function day2_gamesRecord(): Input
    {
        return FileInput::fromLocal(__DIR__ . '/../../../resources/2023/day2.txt');
    }

    public static function day3_engineSchematic(): Input
    {
        return FileInput::fromLocal(__DIR__ . '/../../../resources/2023/day3.txt');
    }

    public static function day4_scratchpadsRecord(): Input
    {
        return FileInput::fromLocal(__DIR__ . '/../../../resources/2023/day4.txt');
    }

    public static function day5_almanac(): Input
    {
        return FileInput::fromLocal(__DIR__ . '/../../../resources/2023/day5.txt');
    }

    public static function day6_sheetOfPaper(): Input
    {
        return FileInput::fromLocal(__DIR__ . '/../../../resources/2023/day6.txt');
    }

    public static function day6_sheetOfPaperWithFixedKerning(): Input
    {
        return FileInput::fromLocal(__DIR__ . '/../../../resources/2023/day6_fixed_kerning.txt');
    }

    public static function day7_listOfHands(): Input
    {
        return FileInput::fromLocal(__DIR__ . '/../../../resources/2023/day7.txt');
    }

    public static function day8_navigation_document(): Input
    {
        return FileInput::fromLocal(__DIR__ . '/../../../resources/2023/day8.txt');
    }

    public static function day9_oasis_report(): Input
    {
        return FileInput::fromLocal(__DIR__ . '/../../../resources/2023/day9.txt');
    }

    public static function day10_pipe_diagram(): Input
    {
        return FileInput::fromLocal(__DIR__ . '/../../../resources/2023/day10.txt');
    }
}
