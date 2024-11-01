<?php

declare(strict_types=1);

namespace Advent\Year2023\Day5\Model\Almanac;

use Advent\Shared\Range\Range;
use Advent\Shared\Range\Ranges;

final readonly class Map
{
    /** @var MapRule[] */
    private array $rules;

    public function __construct(MapRule ...$rules)
    {
        $this->rules = $rules;
    }

    public function destinationNumber(int $sourceNumber): int
    {
        foreach ($this->rules as $rule) {
            if ($rule->isFor($sourceNumber)) {
                return $rule->destinationNumber($sourceNumber);
            }
        }

        return $sourceNumber;
    }

    public function destinationNumberRanges(Ranges $ranges): Ranges
    {
        return $ranges
            ->flatMapRange(fn (Range $range): array => $this->mapIntoSourceRangesBasedOnRules($range))
            ->mapRange(fn (Range $range): Range => new Range(
                $this->destinationNumber($range->start),
                $this->destinationNumber($range->end),
            ))
            ->consolidate();
    }

    /**
     * @param Range $range
     * @return Range[]
     */
    private function mapIntoSourceRangesBasedOnRules(Range $range): array
    {
        $matched = [];
        $leftovers = [$range];

        foreach ($this->rules as $rule) {
            $newLeftovers = [];

            foreach ($leftovers as $leftItem) {
                $intersection = $leftItem->intersection($rule->sourceRange());

                if ($intersection !== null) {
                    $matched[] = $intersection;
                }

                $newLeftovers = array_merge(
                    $leftItem->difference($rule->sourceRange()),
                    $newLeftovers
                );
            }

            $leftovers = $newLeftovers;
        }

        return [...$matched, ...$leftovers];
    }
}
