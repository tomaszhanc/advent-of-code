<?php

declare(strict_types=1);

namespace Advent\Year2023;

use Advent\Shared\Filesystem\Filesystem;
use Advent\Shared\Filesystem\SimpleFilesystem;
use Advent\Shared\Parser\DeprecatedFileLines;
use Advent\Year2023\Day3\Legacy\EngineSchematic;

/** @see https://adventofcode.com/2023/day/3 */
final readonly class Day3
{
    public function __construct(
        private Filesystem $filesystem,
    ) {
    }

    public static function create(): self
    {
        return new self(
            new SimpleFilesystem()
        );
    }

    public function _(string $engineSchematicFilePath): int
    {
        // If you can add up all the part numbers in the engine schematic, it should be easy to work out which part is missing.
        // any number adjacent to a symbol, even diagonally, is a "part number" and should be included in your sum. (Periods (.) do not count as a symbol.)
        // adjacent = sąsiadujący


        // 467..114..
        // ...*......
        // ..35..633.
        // ......#...
        // 617*......
        // .....+.58.
        // ..592.....
        // ......755.
        // ...$.*....
        // .664.598..



        // 114 (top right) and 58 (middle right) nie sasiaduja z partami, wiec nie wliczane sa do sumy
        // Every other number is adjacent to a symbol and so is a part number;
        // their sum is 4361.

        // part Numbers, engine schematic


        return EngineSchematic::create(
            new DeprecatedFileLines(
                new Parser(),
                $this->filesystem,
                $engineSchematicFilePath
            )
        );
    }
}
