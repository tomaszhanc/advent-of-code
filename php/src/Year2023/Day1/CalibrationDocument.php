<?php

declare(strict_types=1);

namespace Advent\Year2023\Day1;

use Advent\Year2023\Day1\CalibrationDocument\CalibrationValues;
use Advent\Year2023\Day1\CalibrationDocument\Line;

final readonly class CalibrationDocument
{
    /**
     * @param Line[] $lines
     */
    public function __construct(private iterable $lines)
    {
    }

    /**
     * @param Line[] $lines
     */
    public static function withLines(iterable $lines): self
    {
        return new self($lines);
    }

    /**
     * This method is not memory-safe.
     * It will keep as many CalibrationValues as lines we have in the memory.
     *
     * @see sumOfCalibrationValues for memory-safe apporach
     */
    public function calibrationValues(): CalibrationValues
    {
        $calibrationValues = [];

        foreach($this->lines as $line) {
            $calibrationValues[] = $line->calibrationValue();
        }

        return CalibrationValues::create(...$calibrationValues);
    }

    /**
     * This method keeps track only of the sum of calibration values.
     * After a line is processed, it no longer uses any memory for it.
     */
    public function sumOfCalibrationValues(): int
    {
        $sum = 0;

        foreach($this->lines as $line) {
            $sum += $line->calibrationValue()->asInteger();
        }

        return $sum;
    }
}
