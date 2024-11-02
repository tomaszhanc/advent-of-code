<?php

declare(strict_types=1);

namespace Advent\Tests\Year2023\Tests\Day6\Parser;

use Advent\Tests\Shared\Assertion\Lexer\SimplifiedToken;
use Advent\Tests\Shared\Assertion\Lexer\TokenAssertion;
use Advent\Year2023\Day6\Parser\RaceLogLexer;
use Advent\Year2023\Day6\Parser\RaceLogType;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class RaceLogLexerTest extends TestCase
{
    use TokenAssertion;

    #[Test]
    public function it_tokenizes_race_log(): void
    {
        $lexer = new RaceLogLexer();
        $racesLog  = "Time:      7  15   30\n";
        $racesLog .= "Distance:  9  40  200";

        $this->assertTokensAreEqual(
            [
                new SimplifiedToken('Time', RaceLogType::TIME),
                new SimplifiedToken('7', RaceLogType::NUMBER),
                new SimplifiedToken('15', RaceLogType::NUMBER),
                new SimplifiedToken('30', RaceLogType::NUMBER),
                SimplifiedToken::endOfLine(RaceLogType::NEW_LINE),
                new SimplifiedToken('Distance', RaceLogType::DISTANCE),
                new SimplifiedToken('9', RaceLogType::NUMBER),
                new SimplifiedToken('40', RaceLogType::NUMBER),
                new SimplifiedToken('200', RaceLogType::NUMBER),
            ],
            iterator_to_array($lexer->tokenize($racesLog)),
        );
    }
}
