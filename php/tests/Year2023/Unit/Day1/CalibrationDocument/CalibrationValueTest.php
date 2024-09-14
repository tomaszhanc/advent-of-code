<?php

declare(strict_types=1);

namespace Advent\Tests\Year2023\Unit\Day1\CalibrationDocument;

use Advent\Year2023\Day1\CalibrationDocument\CalibrationValue;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class CalibrationValueTest extends TestCase
{
    #[Test] #[DataProvider('calibration_values')]
    public function it_casts_calibration_value_to_int(CalibrationValue $calibrationValue, int $expectedInteger): void
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
