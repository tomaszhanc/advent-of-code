<?php

namespace AoC\Year2023\Tests\Day1;

use AoC\Common\Filesystem\SimpleFilesystem;
use AoC\Year2023\Day1\LinesFromFile;
use AoC\Year2023\Doubles\Day1\RandomLineParserStub;
use PHPUnit\Framework\TestCase;

final class LinesFromFileTest extends TestCase
{
    public function test_iterates_over_all_lines_in_the_file(): void
    {
        $lines = new LinesFromFile(
            new RandomLineParserStub(),
            new SimpleFilesystem(),
            __DIR__ . '/../../Resources/day1.txt'
        );

        $this->assertCount(1000, \iterator_to_array($lines->getIterator()));
    }
}
