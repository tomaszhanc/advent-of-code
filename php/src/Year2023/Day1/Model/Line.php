<?php

declare(strict_types=1);

namespace Advent\Year2023\Day1\Model;

use Advent\Shared\Grid\InvalidArgumentException;

final readonly class Line
{
    /**
     * @param Digit[] $digits
     */
    private function __construct(private array $digits)
    {
        if (\count($this->digits) === 0) {
            throw InvalidArgumentException::because('Line cannot be empty');
        }
    }

    public static function create(Digit ...$digits): self
    {
        return new self($digits);
    }

    public function calibrationValue(): CalibrationValue
    {
        return new CalibrationValue(
            $this->digits[\array_key_first($this->digits) ?? 0],
            $this->digits[\array_key_last($this->digits) ?? 0]
        );
    }
}
