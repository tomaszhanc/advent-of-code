<?php

declare(strict_types=1);

namespace AoC\Year2023\Tests\Day1;

use AoC\Year2023\Day1\CalibrationDocument;
use AoC\Year2023\Day1\CalibrationDocument\CalibrationValue;
use AoC\Year2023\Day1\CalibrationDocument\CalibrationValues;
use AoC\Year2023\Day1\CalibrationDocument\Line;
use PHPUnit\Framework\TestCase;

final class CalibrationDocumentTest extends TestCase
{
    public function test_returns_all_calibration_values(): void
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

    public function test_sums_all_calibration_values(): void
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
