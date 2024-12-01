<?php

declare(strict_types=1);

namespace Advent\Tests\Year2024\Tests\Day1\Parser;

use Advent\Shared\Other\NumberList;
use Advent\Tests\Shared\Doubles\InMemoryInput;
use Advent\Year2024\Day1\Model\TwoLists;
use Advent\Year2024\Day1\Parser\Parser;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class ParserTest extends TestCase
{
    #[Test]
    public function it_parses_number_lists(): void
    {
        $parser = new Parser();
        $input = new InMemoryInput(
            '3   4',
            '4   3',
            '2   5',
            '1   3',
            '3   9',
            '3   3',
        );

        $this->assertEquals(
            new TwoLists(
                new NumberList(3, 4, 2, 1, 3, 3),
                new NumberList(4, 3, 5, 3, 9, 3)
            ),
            $parser->parse($input->content())
        );
    }
}
