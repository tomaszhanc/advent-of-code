<?php

declare(strict_types=1);

namespace Advent\Year2023\Day3\Model;

final readonly class PartNumbers
{
    /** @var PartNumber[] */
    private array $partNumbers;

    public function __construct(PartNumber ...$partNumbers)
    {
        $this->partNumbers = $partNumbers;
    }

    public function sum(): int
    {
        return array_sum(array_map(
            fn (PartNumber $partNumber) => $partNumber->number,
            $this->partNumbers
        ));
    }
}
