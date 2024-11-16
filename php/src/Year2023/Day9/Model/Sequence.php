<?php

declare(strict_types=1);

namespace Advent\Year2023\Day9\Model;

final readonly class Sequence
{
    /** @var int[] */
    private array $numbers;

    public function __construct(int ...$numbers)
    {
        $this->numbers = array_values($numbers);
    }

    public function firstNumber(): int
    {
        return $this->numbers[array_key_first($this->numbers)];
    }

    public function lastNumber(): int
    {
        return $this->numbers[array_key_last($this->numbers)];
    }

    public function fullOfZeros(): bool
    {
        foreach ($this->numbers as $number) {
            if ($number !== 0) {
                return false;
            }
        }

        return true;
    }

    public function calculateDifferenceBetweenNeighbors(): self
    {
        return new self(...array_map(
            fn (int $a, int $b) => $b - $a,
            array_slice($this->numbers, 0, -1),
            array_slice($this->numbers, 1)
        ));
    }
}
