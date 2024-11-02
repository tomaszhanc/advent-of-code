<?php

declare(strict_types=1);

namespace Advent\Tests\Year2023\Tests\Day6\Parser;

use Advent\Year2023\Day6\Model\Race;
use Advent\Year2023\Day6\Model\RaceLog;
use Advent\Year2023\Day6\Parser\RaceLogLexer;
use Advent\Year2023\Day6\Parser\RaceLogParser;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class RaceLogParserTest extends TestCase
{
    #[Test]
    public function it_parses_race_log(): void
    {
        $parser = new RaceLogParser(new RaceLogLexer());
        $racesLog  = "Time:      7  15   30\n";
        $racesLog .= "Distance:  9  40  200";

        $this->assertEquals(
            new RaceLog(
                new Race(time: 7, recordDistance: 9),
                new Race(time: 15, recordDistance: 40),
                new Race(time: 30, recordDistance: 200)
            ),
            $parser->parse($racesLog)
        );
    }
}
