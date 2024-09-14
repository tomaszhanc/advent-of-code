<?php

namespace Advent\Tests\Shared\Unit;

use Advent\Shared\Filesystem\SimpleFilesystem;
use Advent\Shared\Parser\ParsedLineByLine;
use Advent\Tests\Shared\Doubles\StdObjectLineParserStub;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class ParseFromFileTest extends TestCase
{
    #[Test]
    public function it_iterates_over_all_lines_in_the_file(): void
    {
        $lines = new ParsedLineByLine(
            new StdObjectLineParserStub(),
            new SimpleFilesystem(),
            __DIR__ . '/../Resources/1000_lines.txt'
        );

        $this->assertCount(1000, \iterator_to_array($lines->getIterator()));
    }
}
