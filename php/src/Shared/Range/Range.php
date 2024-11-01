<?php

declare(strict_types=1);

namespace Advent\Shared\Range;

use Traversable;

final readonly class Range implements \IteratorAggregate
{
    public function __construct(
        public int $start,
        public int $end
    ) {
        if ($start > $end) {
            throw new InvalidArgumentException('Start must be less than end. Given start: ' . $start . ' and end: ' . $end);
        }
    }

    public static function ofLength(int $start, int $length): self
    {
        return new self($start, $start + $length - 1);
    }

    public function intersects(Range $range): bool
    {
        return $this->end >= $range->start && $this->start <= $range->end;
    }

    public function intersection(Range $other): ?self
    {
        if (!$this->intersects($other)) {
            return null;
        }

        return new Range(max($this->start, $other->start), min($this->end, $other->end));
    }

    /** @return Range[] */
    public function difference(Range $range): array
    {
        if (!$this->intersects($range)) {
            return [$this];
        }

        $ranges = [];

        if ($this->start < $range->start) {
            $ranges[] = new Range($this->start, $range->start - 1);
        }

        if ($this->end > $range->end) {
            $ranges[] = new Range($range->end + 1, $this->end);
        }

        return $ranges;
    }

    public function getIterator(): Traversable
    {
        for ($i = $this->start; $i <= $this->end; $i++) {
            yield $i;
        }
    }
}
