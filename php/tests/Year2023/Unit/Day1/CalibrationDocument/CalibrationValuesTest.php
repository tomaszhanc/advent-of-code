<?php

namespace Advent\Tests\Year2023\Unit\Day1\CalibrationDocument;

use Advent\Year2023\Day1\CalibrationDocument\CalibrationValue;
use Advent\Year2023\Day1\CalibrationDocument\CalibrationValues;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class CalibrationValuesTest extends TestCase
{
    #[Test]
    public function it_sums_all_calibration_values(): void
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
