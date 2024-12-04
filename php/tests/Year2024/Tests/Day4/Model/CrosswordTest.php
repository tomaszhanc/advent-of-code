<?php

declare(strict_types=1);

namespace Advent\Tests\Year2024\Tests\Day4\Model;

use Advent\Tests\Shared\Doubles\InMemoryInput;
use Advent\Year2024\Day4\Parser\CrosswordParser;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class CrosswordTest extends TestCase
{
    #[Test]
    public function it_finds_for_number_of_occurrences(): void
    {
        $crossword = new CrosswordParser()->parse(new InMemoryInput(
            '..X...',
            '.SAMX.',
            '.A..A.',
            'XMAS.S',
            '.X...',
        ));

        $this->assertEquals(4, $crossword->numberOfOccurrences('XMAS'));
    }
}
