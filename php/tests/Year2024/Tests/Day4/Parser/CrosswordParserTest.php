<?php

declare(strict_types=1);

namespace Advent\Tests\Year2024\Tests\Day4\Parser;

use Advent\Shared\Grid\Cell\StringCell;
use Advent\Tests\Shared\Doubles\InMemoryInput;
use Advent\Year2024\Day4\Model\Crossword;
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
                new StringCell(x: 0, y: 0, value: 'M'),
                new StringCell(x: 1, y: 0, value: 'M'),
                new StringCell(x: 2, y: 0, value: 'M'),
                new StringCell(x: 3, y: 0, value: 'S'),
                new StringCell(x: 0, y: 1, value: 'M'),
                new StringCell(x: 1, y: 1, value: 'S'),
                new StringCell(x: 2, y: 1, value: 'A'),
                new StringCell(x: 3, y: 1, value: 'M'),
                new StringCell(x: 0, y: 2, value: 'A'),
                new StringCell(x: 1, y: 2, value: 'M'),
                new StringCell(x: 2, y: 2, value: 'X'),
                new StringCell(x: 3, y: 2, value: 'S'),
            ),
            $parser->parse($input)
        );
    }

}
