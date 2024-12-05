<?php

declare(strict_types=1);

namespace Advent\Shared\Other;

use Advent\Shared\InvalidArgumentException;

final class NumberListBuilder
{
    /** @var int[] */
    private array $numbers = [];

    public function add(int ...$numbers): void
    {
        foreach ($numbers as $number) {
            $this->numbers[] = $number;
        }
    }

    public function remove(int $number): void
    {
        $index = array_search($number, $this->numbers, true);

        if ($index !== false) {
            unset($this->numbers[$index]);
            $this->numbers = array_values($this->numbers);
        }
    }

    public function indexOf(int $number): ?int
    {
        $index = array_search($number, $this->numbers, true);

        return $index === false ? null : $index;
    }

    public function putBefore(int $newNumber, int $number): void
    {
        $index = array_search($number, $this->numbers, true);

        if ($index === false) {
            throw new InvalidArgumentException('Number not found');
        }

        array_splice($this->numbers, $index, 0, [$newNumber]);
    }

    public function putAfter(int $newNumber, int $number): void
    {
        $index = array_search($number, $this->numbers, true);

        if ($index === false) {
            throw new InvalidArgumentException('Number not found');
        }

        array_splice($this->numbers, $index + 1, 0, [$newNumber]);
    }

    public function build(): NumberList
    {
        return new NumberList(...$this->numbers);
    }
}
