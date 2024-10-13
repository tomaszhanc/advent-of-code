<?php

declare(strict_types=1);

namespace Advent\Tests\Year2023\Unit\Day1;

use Advent\Tests\Shared\Doubles\FileStub;
use Advent\Year2023\Day1\AllLinesCalibrationValues;
use Advent\Year2023\Day1\Parser\DigitLexer;
use Advent\Year2023\Day1\Parser\DigitLineParser;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class AllLinesCalibrationValuesTest extends TestCase
{
    #[Test]
    public function it_sum_all_lines_calibration_values(): void
    {
        $compiler = new AllLinesCalibrationValues(
            new DigitLineParser(
                DigitLexer::numericDigitsOnly()
            )
        );
        $file = new FileStub('zoneight234', 'a1b2c3d4e5f');

        $this->assertSame(24 + 15, $compiler->sumAllFrom($file));
    }
}
