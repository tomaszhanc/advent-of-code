<?php

declare(strict_types=1);

namespace AoC\Year2023\Day1;

interface LineCalibrator
{
    public function calibrationNumber(string $line) : CalibrationNumber;
}