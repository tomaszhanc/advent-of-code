<?php

declare(strict_types=1);

namespace Advent\Tests\Year2023\Tests\Day3;

use Advent\Shared\Lexer\Lexer;
use Advent\Tests\Shared\Doubles\InMemoryInput;
use Advent\Year2023\Day3\Parser\EngineSchematicType;
use Advent\Year2023\Day3\PuzzleSolver;
use Advent\Year2023\Day3\Model\PartNumbersFactory;
use Advent\Year2023\Day3\Parser\EngineSchematicParser;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class PartNumbersEvaluatorTest extends TestCase
{
    #[Test]
    public function it_sums_numbers_of_all_elements_that_are_part_numbers(): void
    {
        $partNumbersEvaluator = new PuzzleSolver(
            new EngineSchematicParser(new Lexer(EngineSchematicType::class)),
            new PartNumbersFactory()
        );

        $file = new InMemoryInput(
            '467..114..',
            '...*......',
            '..35..633.',
            '......#...',
            '617*......',
            '.....+.58.',
            '..592.....',
            '......755.',
            '...$.*....',
            '.664.598..',
        );

        $this->assertEquals(4361, $partNumbersEvaluator->sumAllPartNumbers($file));
    }
}
