<?php

declare(strict_types=1);

namespace Advent\Tests\Year2023\Tests\Day5\Parser;

use Advent\Year2023\Day5\Model\Almanac;
use Advent\Year2023\Day5\Model\Almanac\Map;
use Advent\Year2023\Day5\Model\Almanac\MapRange;
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
                    new MapRange(50, 98, 2),
                    new MapRange(52, 50, 48),
                ),
                new Map(
                    new MapRange(0, 15, 37),
                    new MapRange(37, 52, 2),
                    new MapRange(39, 0, 15),
                ),
                new Map(
                    new MapRange(49, 53, 8),
                    new MapRange(0, 11, 42),
                    new MapRange(42, 0, 7),
                    new MapRange(57, 7, 4),
                ),
                new Map(
                    new MapRange(88, 18, 7),
                    new MapRange(18, 25, 70),
                ),
                new Map(
                    new MapRange(45, 77, 23),
                    new MapRange(81, 45, 19),
                    new MapRange(68, 64, 13),
                ),
                new Map(
                    new MapRange(0, 69, 1),
                    new MapRange(1, 0, 69),
                ),
                new Map(
                    new MapRange(60, 56, 37),
                    new MapRange(56, 93, 4),
                ),
            ),
            $parser->parse($input)
        );
    }
}
