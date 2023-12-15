<?php

declare(strict_types=1);

namespace AoC\Year2023\Tests\Day1\CalibrationDocument;

use AoC\Year2023\Day1\CalibrationDocument\CalibrationValue;
use AoC\Year2023\Day1\CalibrationDocument\Line;
use PHPUnit\Framework\TestCase;

final class LineTest extends TestCase
{
    public function test_cannot_be_empty(): void
    {
        $this->expectExceptionMessage('Line cannot be empty');

        Line::create();
    }

    /**
     * @dataProvider lines
     */
    public function test_creates_a_calibration_value_from_the_first_and_the_last_digit_in_the_line(Line $line, CalibrationValue $expectedCalibrationValue): void
    {
        $this->assertEquals($expectedCalibrationValue, $line->calibrationValue());
    }

    public static function lines(): iterable
    {
        yield 'single digit in a line' => [
            Line::of(7),
            CalibrationValue::of(7, 7),
        ];

        yield 'multiple digits in a line' => [
            Line::of(5, 1, 9, 2),
            CalibrationValue::of(5, 2),
        ];
    }
}
