<?php

declare(strict_types=1);

namespace Advent\Tests\Year2023\Unit\Day1;

use Advent\Year2023\Day1\CalibrationDocument;
use Advent\Year2023\Day1\CalibrationDocument\CalibrationValue;
use Advent\Year2023\Day1\CalibrationDocument\CalibrationValues;
use Advent\Year2023\Day1\CalibrationDocument\Line;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class CalibrationDocumentTest extends TestCase
{
    #[Test]
    public function it_returns_all_calibration_values(): void
    {
        $lines = new CalibrationDocument([
            Line::of(1, 2),
            Line::of(3, 8),
            Line::of(1, 2, 3, 4, 5),
            Line::of(7),
        ]);

        $this->assertEquals(
            CalibrationValues::create(
                CalibrationValue::of(1, 2),
                CalibrationValue::of(3, 8),
                CalibrationValue::of(1, 5),
                CalibrationValue::of(7, 7),
            ),
            $lines->calibrationValues()
        );
    }

    #[Test]
    public function it_sums_all_calibration_values(): void
    {
        $lines = new CalibrationDocument([
            Line::of(1, 2),
            Line::of(3, 8),
            Line::of(1, 2, 3, 4, 5),
            Line::of(7),
        ]);

        $this->assertSame(142, $lines->sumOfCalibrationValues());
    }
}
