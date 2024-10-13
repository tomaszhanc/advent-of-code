<?php

declare(strict_types=1);

namespace Advent\Tests\Year2023\Unit\Day1;

use Advent\Year2023\Day1\CalibrationValue;
use Advent\Year2023\Day1\Digit;
use Advent\Year2023\Day1\Line;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class LineTest extends TestCase
{
    #[Test]
    public function it_cannot_be_empty(): void
    {
        $this->expectExceptionMessage('Line cannot be empty');

        Line::create();
    }

    #[Test] #[DataProvider('lines')]
    public function it_creates_a_calibration_value_from_the_first_and_the_last_digit_in_the_line(Line $line, CalibrationValue $expectedCalibrationValue): void
    {
        $this->assertEquals($expectedCalibrationValue, $line->calibrationValue());
    }

    public static function lines(): iterable
    {
        yield 'single digit in a line' => [
            Line::create($digit = new Digit(7)),
            new CalibrationValue($digit, $digit),
        ];

        yield 'multiple digits in a line' => [
            Line::create(
                $first = new Digit(5),
                new Digit(1),
                new Digit(9),
                $last = new Digit(2)
            ),
            new CalibrationValue($first, $last),
        ];
    }
}
