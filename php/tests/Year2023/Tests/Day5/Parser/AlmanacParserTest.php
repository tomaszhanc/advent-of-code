<?php

declare(strict_types=1);

namespace Advent\Tests\Year2023\Tests\Day5\Parser;

use Advent\Year2023\Day5\Model\Almanac;
use Advent\Year2023\Day5\Model\Almanac\Map;
use Advent\Year2023\Day5\Model\Almanac\Range;
use Advent\Year2023\Day5\Model\Almanac\Seeds;
use Advent\Year2023\Day5\Parser\AlmanacLexer;
use Advent\Year2023\Day5\Parser\AlmanacParser;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class AlmanacParserTest extends TestCase
{
    #[Test]
    public function it_parses_almanac(): void
    {
        $parser = new AlmanacParser(new AlmanacLexer());
        $input = file_get_contents(__DIR__ . '/../../../Resources/test_day5.txt');

        $this->assertEquals(
            new Almanac(
                new Seeds(79, 14, 55, 13),
                new Map(
                    new Range(50, 98, 2),
                    new Range(52, 50, 48),
                ),
                new Map(
                    new Range(0, 15, 37),
                    new Range(37, 52, 2),
                    new Range(39, 0, 15),
                ),
                new Map(
                    new Range(49, 53, 8),
                    new Range(0, 11, 42),
                    new Range(42, 0, 7),
                    new Range(57, 7, 4),
                ),
                new Map(
                    new Range(88, 18, 7),
                    new Range(18, 25, 70),
                ),
                new Map(
                    new Range(45, 77, 23),
                    new Range(81, 45, 19),
                    new Range(68, 64, 13),
                ),
                new Map(
                    new Range(0, 69, 1),
                    new Range(1, 0, 69),
                ),
                new Map(
                    new Range(60, 56, 37),
                    new Range(56, 93, 4),
                ),
            ),
            $parser->parse($input)
        );
    }
}
