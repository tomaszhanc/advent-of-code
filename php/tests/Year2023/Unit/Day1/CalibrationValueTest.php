<?php

declare(strict_types=1);

namespace Advent\Tests\Year2023\Unit\Day1;

use Advent\Year2023\Day1\CalibrationValue;
use Advent\Year2023\Day1\Digit;
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
            new CalibrationValue(new Digit(4), new Digit(8)),
            48,
        ];

        yield [
            new CalibrationValue(new Digit(9), new Digit(0)),
            90,
        ];

        yield [
            new CalibrationValue(new Digit(0), new Digit(7)),
            7,
        ];

        yield [
            new CalibrationValue(new Digit(0), new Digit(0)),
            0,
        ];
    }
}
