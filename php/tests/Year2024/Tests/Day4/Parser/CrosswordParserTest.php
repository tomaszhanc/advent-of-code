<?php

declare(strict_types=1);

namespace Advent\Tests\Year2024\Tests\Day4\Parser;

use Advent\Shared\Grid\Location;
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
                new Square(new Location(0, 0), 'M'),
                new Square(new Location(1, 0), 'M'),
                new Square(new Location(2, 0), 'M'),
                new Square(new Location(3, 0), 'S'),
                new Square(new Location(0, 1), 'M'),
                new Square(new Location(1, 1), 'S'),
                new Square(new Location(2, 1), 'A'),
                new Square(new Location(3, 1), 'M'),
                new Square(new Location(0, 2), 'A'),
                new Square(new Location(1, 2), 'M'),
                new Square(new Location(2, 2), 'X'),
                new Square(new Location(3, 2), 'S'),
            ),
            $parser->parse($input)
        );
    }

}
