<?php

namespace AoC\Year2023\Tests\Day1\CalibrationDocument;

use AoC\Year2023\Day1\CalibrationDocument\CalibrationValue;
use AoC\Year2023\Day1\CalibrationDocument\CalibrationValues;
use PHPUnit\Framework\TestCase;

final class CalibrationValuesTest extends TestCase
{
    public function test_sums_all_calibration_values(): void
    {
        $calibrationValues = CalibrationValues::create(
            CalibrationValue::of(1, 2),
            CalibrationValue::of(3, 8),
            CalibrationValue::of(1, 5),
            CalibrationValue::of(7, 7),
        );

        $this->assertSame(142, $calibrationValues->sum());
    }
}
