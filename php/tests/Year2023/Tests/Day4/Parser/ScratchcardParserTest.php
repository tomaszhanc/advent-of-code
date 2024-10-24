<?php

declare(strict_types=1);

namespace Advent\Tests\Year2023\Tests\Day4\Parser;

use Advent\Year2023\Day4\Model\Scratchcard;
use Advent\Year2023\Day4\Parser\ScratchcardLexer;
use Advent\Year2023\Day4\Parser\ScratchcardParser;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class ScratchcardParserTest extends TestCase
{
    #[Test]
    public function it_parses_scratchcard(): void
    {
        $parser = new ScratchcardParser(new ScratchcardLexer());
        $line = 'Card 1: 41 48 83 86 17 | 83 86  6 31 17  9 48 53';

        $this->assertEquals(
            new Scratchcard(
                1,
                [41, 48, 83, 86, 17],
                [83, 86, 6, 31, 17, 9, 48, 53]
            ),
            $parser->parse($line)
        );
    }
}
