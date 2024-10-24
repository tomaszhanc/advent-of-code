<?php

declare(strict_types=1);

namespace Advent\Tests\Year2023\Unit;

use Advent\Shared\Filesystem\LocalFile;
use Advent\Year2023\Day3;
use Advent\Year2023\Day3\GearsEvaluator;
use Advent\Year2023\Day3\Model\GearsFactory;
use Advent\Year2023\Day3\Model\PartNumbersFactory;
use Advent\Year2023\Day3\Parser\EngineSchematicLexer;
use Advent\Year2023\Day3\Parser\EngineSchematicParser;
use Advent\Year2023\Day3\PartNumbersEvaluator;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class Day3Test extends TestCase
{
    #[Test]
    public function day_3_part_1_sum_all_part_numbers(): void
    {
        $partNumbersEvaluator = new PartNumbersEvaluator(
            new EngineSchematicParser(new EngineSchematicLexer()),
            new PartNumbersFactory()
        );

        $this->assertEquals(
            544433,
            $partNumbersEvaluator->sumAllPartNumbers(RiddleInputs::day3_engineSchematic())
        );
    }

    #[Test]
    public function day_3_part_2_sum_all_gear_ratios(): void
    {
        $gearsEvaluator = new GearsEvaluator(
            new EngineSchematicParser(new EngineSchematicLexer()),
            new GearsFactory()
        );

        $this->assertEquals(
            76314915,
            $gearsEvaluator->sumAllGearRatios(RiddleInputs::day3_engineSchematic())
        );
    }
}
