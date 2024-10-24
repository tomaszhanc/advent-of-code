<?php

declare(strict_types=1);

namespace Advent\Tests\Year2023\Unit\Day3;

use Advent\Tests\Shared\Doubles\FileStub;
use Advent\Year2023\Day3\GearsEvaluator;
use Advent\Year2023\Day3\Model\GearsFactory;
use Advent\Year2023\Day3\Parser\EngineSchematicParser;
use Advent\Year2023\Day3\Parser\EngineSchematicLexer;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class GearsEvaluatorTest extends TestCase
{
    #[Test]
    public function it_sums_all_gear_ratios(): void
    {
        $gearsEvaluator = new GearsEvaluator(
            new EngineSchematicParser(new EngineSchematicLexer()),
            new GearsFactory()
        );

        $file = new FileStub(
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

        $this->assertEquals(467835, $gearsEvaluator->sumAllGearRatios($file));
    }
}
