<?php

declare(strict_types=1);

namespace Advent\Shared\Other;

final readonly class NumberList
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
}
