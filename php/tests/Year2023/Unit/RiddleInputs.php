<?php
declare(strict_types=1);

namespace Advent\Tests\Year2023\Unit;

use Advent\Shared\Filesystem\File;
use Advent\Shared\Filesystem\LocalFile;

final readonly class RiddleInputs
{
    public static function day3_engineSchematic() : File
    {
        return LocalFile::create(__DIR__ . '/../../../resources/day3.txt');
    }
}
