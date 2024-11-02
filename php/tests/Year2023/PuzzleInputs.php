<?php

declare(strict_types=1);

namespace Advent\Tests\Year2023;

use Advent\Shared\Filesystem\File;
use Advent\Shared\Filesystem\LocalFile;

final readonly class PuzzleInputs
{
    public static function day1_calibrationDocument(): File
    {
        return LocalFile::create(__DIR__ . '/../../resources/day1.txt');
    }

    public static function day2_gamesRecord(): File
    {
        return LocalFile::create(__DIR__ . '/../../resources/day2.txt');
    }

    public static function day3_engineSchematic(): File
    {
        return LocalFile::create(__DIR__ . '/../../resources/day3.txt');
    }

    public static function day4_scratchpadsRecord(): File
    {
        return LocalFile::create(__DIR__ . '/../../resources/day4.txt');
    }

    public static function day5_almanac(): File
    {
        return LocalFile::create(__DIR__ . '/../../resources/day5.txt');
    }

    public static function day6_sheetOfPaper(): File
    {
        return LocalFile::create(__DIR__ . '/../../resources/day6.txt');
    }

    public static function day6_sheetOfPaperWithFixedKerning(): File
    {
        return LocalFile::create(__DIR__ . '/../../resources/day6_fixed_kerning.txt');
    }
}
