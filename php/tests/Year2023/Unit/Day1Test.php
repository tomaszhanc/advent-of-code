<?php

declare(strict_types=1);

namespace Advent\Tests\Year2023\Unit;

use Advent\Year2023\Day1;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class Day1Test extends TestCase
{
    private Day1 $day1;

    private string $calibrationDocumentPath;

    protected function setUp(): void
    {
        $this->day1 = Day1::create();
        $this->calibrationDocumentPath = __DIR__ . '/../Resources/day1.txt';
    }

    #[Test]
    public function part_one_sum_of_all_calibration_values_built_from_integers_only(): void
    {
        $this->assertEquals(54597, $this->day1->sumOfAllCalibrationValuesBuiltFromIntegersOnly($this->calibrationDocumentPath));
    }

    #[Test]
    public function part_two_sum_of_all_calibration_values_built_from_integers_and_spelled_out_numbers(): void
    {
        $this->assertEquals(54504, $this->day1->sumOfAllCalibrationValuesBuiltFromIntegersAndSpelledOutDigits($this->calibrationDocumentPath));
        $this->assertEquals(54504, $this->day1->sumOfAllCalibrationValuesBuiltFromIntegersAndSpelledOutDigits_MemorySafe($this->calibrationDocumentPath));
        $this->assertEquals(54504, $this->day1->sumOfAllCalibrationValuesBuiltFromIntegersAndSpelledOutDigits_SimpleParser($this->calibrationDocumentPath));
    }
}
