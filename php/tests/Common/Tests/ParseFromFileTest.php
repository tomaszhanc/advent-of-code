<?php

namespace AoC\Common\Tests;

use AoC\Common\Doubles\StdObjectParserStub;
use AoC\Common\Filesystem\SimpleFilesystem;
use AoC\Common\ParseFromFile;
use PHPUnit\Framework\TestCase;

final class ParseFromFileTest extends TestCase
{
    public function test_iterates_over_all_lines_in_the_file(): void
    {
        $lines = new ParseFromFile(
            new StdObjectParserStub(),
            new SimpleFilesystem(),
            __DIR__ . '/../Resources/1000_lines.txt'
        );

        $this->assertCount(1000, \iterator_to_array($lines->getIterator()));
    }
}
