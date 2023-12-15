<?php

declare(strict_types=1);

namespace AoC\Year2023\Day1\CalibrationDocument;

final readonly class CalibrationValues
{
    /**
     * @param CalibrationValue[] $calibrationValues
     */
    private function __construct(private array $calibrationValues)
    {
    }

    public static function create(CalibrationValue ...$calibrationValues): self
    {
        return new self($calibrationValues);
    }

    public function sum(): int
    {
        return \array_sum(
            \array_map(
                fn (CalibrationValue $calibrationValue) => $calibrationValue->asInteger(),
                $this->calibrationValues
            )
        );
    }
}
