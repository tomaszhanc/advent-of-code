<?php

declare(strict_types=1);

namespace Advent\Shared\Range;

use Traversable;

final readonly class Ranges implements \IteratorAggregate
{
    /** @var Range[] */
    private array $ranges;

    public function __construct(Range ...$ranges)
    {
        usort($ranges, fn (Range $a, Range $b) => $a->start <=> $b->start);
        $this->ranges = $ranges;
    }

    /**
     * @param Range[] $ranges
     */
    public static function fromArray(array $ranges): self
    {
        return new self(...$ranges);
    }

    public function consolidate(): self
    {
        if (count($this->ranges) === 0) {
            return $this;
        }

        $consolidated = [];
        $current = $this->ranges[0];

        foreach ($this->ranges as $range) {
            if ($range->start <= $current->end + 1) {
                $current = new Range($current->start, max($current->end, $range->end));
            } else {
                $consolidated[] = $current;
                $current = $range;
            }
        }

        return new self($current, ...$consolidated);
    }

    /**
     * @template T
     * @param callable(Range) : T $mapper
     * @return T[]
     */
    public function map(callable $mapper): array
    {
        return array_map($mapper, $this->ranges);
    }

    /**
     * @param callable(Range) : Range $mapper
     */
    public function mapRange(callable $mapper): self
    {
        return self::fromArray($this->map($mapper));
    }

    /**
     * @template T
     * @param callable(Range) : T[] $mapper
     * @return T[]
     */
    public function flatMap(callable $mapper): array
    {
        return array_merge(...$this->map($mapper));
    }

    /**
     * @param callable(Range) : Range[] $mapper
     */
    public function flatMapRange(callable $mapper): self
    {
        return self::fromArray($this->flatMap($mapper));
    }

    public function min(): int
    {
        return min(
            array_map(fn (Range $range) => $range->start, $this->ranges)
        );
    }

    public function getIterator(): Traversable
    {
        foreach ($this->ranges as $range) {
            yield $range;
        }
    }
}
