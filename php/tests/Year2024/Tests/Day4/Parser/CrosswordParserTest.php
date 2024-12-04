<?php

declare(strict_types=1);

namespace Advent\Tests\Year2024\Tests\Day4\Parser;

use Advent\Tests\Shared\Doubles\InMemoryInput;
use Advent\Year2024\Day4\Model\Crossword;
use Advent\Year2024\Day4\Model\Square;
use Advent\Year2024\Day4\Parser\CrosswordParser;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class CrosswordParserTest extends TestCase
{
    #[Test]
    public function it_parses_crossword(): void
    {
        $parser = new CrosswordParser();
        $input = new InMemoryInput(
            'MMMS',
            'MSAM',
            'AMXS',
        );

        $this->assertEquals(
            new Crossword(
                new Square(x: 0, y: 0, letter: 'M'),
                new Square(x: 1, y: 0, letter: 'M'),
                new Square(x: 2, y: 0, letter: 'M'),
                new Square(x: 3, y: 0, letter: 'S'),
                new Square(x: 0, y: 1, letter: 'M'),
                new Square(x: 1, y: 1, letter: 'S'),
                new Square(x: 2, y: 1, letter: 'A'),
                new Square(x: 3, y: 1, letter: 'M'),
                new Square(x: 0, y: 2, letter: 'A'),
                new Square(x: 1, y: 2, letter: 'M'),
                new Square(x: 2, y: 2, letter: 'X'),
                new Square(x: 3, y: 2, letter: 'S'),
            ),
            $parser->parse($input)
        );
    }

}
