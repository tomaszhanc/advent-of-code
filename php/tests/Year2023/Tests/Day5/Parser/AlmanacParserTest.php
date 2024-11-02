<?php

declare(strict_types=1);

namespace Advent\Tests\Year2023\Tests\Day5\Parser;

use Advent\Shared\Lexer\Lexer;
use Advent\Year2023\Day5\Model\Almanac;
use Advent\Year2023\Day5\Model\Almanac\Map;
use Advent\Year2023\Day5\Model\Almanac\MapRule;
use Advent\Year2023\Day5\Model\Almanac\Seeds;
use Advent\Year2023\Day5\Parser\AlmanacParser;
use Advent\Year2023\Day5\Parser\AlmanacType;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class AlmanacParserTest extends TestCase
{
    #[Test]
    public function it_parses_almanac(): void
    {
        $parser = new AlmanacParser(new Lexer(AlmanacType::class));
        $input = file_get_contents(__DIR__ . '/../../../Resources/test_day5.txt');

        $this->assertEquals(
            new Almanac(
                new Seeds(79, 14, 55, 13),
                new Map(
                    MapRule::create(50, 98, 2),
                    MapRule::create(52, 50, 48),
                ),
                new Map(
                    MapRule::create(0, 15, 37),
                    MapRule::create(37, 52, 2),
                    MapRule::create(39, 0, 15),
                ),
                new Map(
                    MapRule::create(49, 53, 8),
                    MapRule::create(0, 11, 42),
                    MapRule::create(42, 0, 7),
                    MapRule::create(57, 7, 4),
                ),
                new Map(
                    MapRule::create(88, 18, 7),
                    MapRule::create(18, 25, 70),
                ),
                new Map(
                    MapRule::create(45, 77, 23),
                    MapRule::create(81, 45, 19),
                    MapRule::create(68, 64, 13),
                ),
                new Map(
                    MapRule::create(0, 69, 1),
                    MapRule::create(1, 0, 69),
                ),
                new Map(
                    MapRule::create(60, 56, 37),
                    MapRule::create(56, 93, 4),
                ),
            ),
            $parser->parse($input)
        );
    }
}
