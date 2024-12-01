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
        $this->numbers = $numbers;
    }

    public function sortedAscending(): array
    {
        $numbers = $this->numbers;
        sort($numbers);

        return $numbers;
    }

    public function occurrenceOf(int $number): int
    {
        return array_count_values($this->numbers)[$number] ?? 0;
    }

    public function getIterator(): Traversable
    {
        return new \ArrayIterator($this->numbers);
    }
}
