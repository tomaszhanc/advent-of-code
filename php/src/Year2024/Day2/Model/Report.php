<?php
declare(strict_types=1);

namespace Advent\Year2024\Day2\Model;

use Advent\Shared\Iterator\LookaroundIterator;
use Advent\Year2024\Day2\Model\Rule\AlwaysDecreasingMaximumBy3;
use Advent\Year2024\Day2\Model\Rule\AlwaysIncreasingMaximumBy3;

final readonly class Report
{
    private array $numbers;

    public function __construct(
        int ...$numbers
    ) {
        $this->numbers = $numbers;
    }

    public function isSafe() : bool
    {
        $iterator = LookaroundIterator::fromArray($this->numbers);

        if ($iterator->lookahead() === $iterator->current()) {
            return false;
        }

        $rule = $iterator->lookahead() > $iterator->current()
            ? new AlwaysIncreasingMaximumBy3()
            : new AlwaysDecreasingMaximumBy3();

        while ($iterator->lookahead() !== null) {
            if (!$rule->isSatisfied($iterator->current(), $iterator->lookahead())) {
                return false;
            }

            $iterator->next();
        }

        return true;
    }

    public function toString() : string
    {
        return implode(' ', $this->numbers) . "\n";
    }
}
