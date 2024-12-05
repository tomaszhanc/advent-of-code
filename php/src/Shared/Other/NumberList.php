<?php

declare(strict_types=1);

namespace Advent\Shared\Other;

use Traversable;

final readonly class NumberList implements \IteratorAggregate
{
    /** @var int[] */
    private array $numbers;

    public function __construct(int ...$numbers)
    {
        $this->numbers = array_values($numbers);
    }

    public function occurrenceOf(int $number): int
    {
        return array_count_values($this->numbers)[$number] ?? 0;
    }

    public function indexOf(int $number): int
    {
        return array_search($number, $this->numbers, true);
    }

    public function middleNumber(): int
    {
        return $this->numbers[array_key_last($this->numbers) / 2];
    }

    public function sortedAscending(): array
    {
        $numbers = $this->numbers;
        sort($numbers);

        return $numbers;
    }

    public function sort(callable $compare): array
    {
        $numbers = $this->numbers;
        usort($numbers, $compare);

        return $numbers;
    }

    public function equals(NumberList $list): bool
    {
        return $this->numbers === $list->numbers;
    }

    /**
     * @template T
     * @param callable(int) : T $mapper
     * @return T[]
     */
    public function map(callable $mapper): array
    {
        return array_map($mapper, $this->numbers);
    }

    public function getIterator(): Traversable
    {
        return new \ArrayIterator($this->numbers);
    }

    public function toArray(): array
    {
        return $this->numbers;
    }
}
