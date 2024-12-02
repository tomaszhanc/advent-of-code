<?php

declare(strict_types=1);

namespace Advent\Year2024\Day2\Model;

use Advent\Year2024\Day2\Model\Rule\AlwaysDecreasingMaximumBy3;
use Advent\Year2024\Day2\Model\Rule\AlwaysIncreasingMaximumBy3;

final readonly class Report
{
    /** @var int[] */
    private array $numbers;

    public function __construct(
        int ...$numbers
    ) {
        $this->numbers = $numbers;
    }

    public function isSafe(): bool
    {
        $rule = $this->numbers[0] < $this->numbers[1]
            ? new AlwaysIncreasingMaximumBy3()
            : new AlwaysDecreasingMaximumBy3();

        for ($i = 0; $i < count($this->numbers) - 1; $i++) {
            if (!$rule->isSatisfied($this->numbers[$i], $this->numbers[$i + 1])) {
                return false;
            }
        }

        return true;
    }

    public function isSafeWithAtMostSingleBadLevel(): bool
    {
        $rule = $this->numbers[0] < $this->numbers[1]
            ? new AlwaysIncreasingMaximumBy3()
            : new AlwaysDecreasingMaximumBy3();

        for ($i = 0; $i < count($this->numbers) - 1; $i++) {
            if ($rule->isSatisfied($this->numbers[$i], $this->numbers[$i + 1])) {
                continue;
            }

            if ($this->withoutNumberAtIndex($i)->isSafe()) {
                return true;
            }

            return $this->withoutNumberAtIndex($i + 1)->isSafe();
        }

        return true;
    }

    private function withoutNumberAtIndex(int $index): self
    {
        $numbers = $this->numbers;
        unset($numbers[$index]);

        return new self(...$numbers);
    }
}
