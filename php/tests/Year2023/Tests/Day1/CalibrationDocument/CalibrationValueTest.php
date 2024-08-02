<?php

declare(strict_types=1);

namespace AoC\Year2023\Tests\Day1\CalibrationDocument;

use AoC\Year2023\Day1\CalibrationDocument\CalibrationValue;
use PHPUnit\Framework\TestCase;

final class CalibrationValueTest extends TestCase
{
    /**
     * @dataProvider calibration_values
     */
    public function test_casts_calibration_value_to_int(CalibrationValue $calibrationValue, int $expectedInteger): void
    {
        $this->assertSame($expectedInteger, $calibrationValue->asInteger());
    }

    public static function calibration_values(): iterable
    {
        yield [
            CalibrationValue::of(4, 8),
            48,
        ];

        yield [
            CalibrationValue::of(9, 0),
            90,
        ];

        yield [
            CalibrationValue::of(0, 7),
            7,
        ];

        yield [
            CalibrationValue::of(0, 0),
            0,
        ];
    }
}
