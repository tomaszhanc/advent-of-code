<?php

declare(strict_types=1);

namespace Advent\Year2023\Day6\Model;

use Advent\Shared\Range\Range;

final readonly class Race
{
    public function __construct(
        public int $time,
        public int $recordDistance,
    ) {
    }

    public function waysToWin(): int
    {
        return $this->winningTimeRangeForChargingTheBoat()->length();
    }

    /**
     * Given:
     *  H = hold to charge (unknown value to find)
     *  T = maximum time
     *  R = record distance
     *  D = distance, and D > R
     *
     * To calculate the winning range for H (hold to charge), we have:
     *  D = (T - H) * H
     *  D = -H^2 + TH
     *
     * This method solves the quadratic equation for H:
     *  -H^2 + TH > R
     */
    public function winningTimeRangeForChargingTheBoat(): Range
    {
        $sqrt = sqrt(pow($this->time, 2) - 4 * $this->recordDistance);

        $minChargeTime = ($this->time / 2) - ($sqrt / 2);
        $maxChargeTime = ($this->time / 2) + ($sqrt / 2);

        // Result is a range:
        //   from: nearest integer greater than minChargeTime
        //     to: nearest integer less than maxChargeTime
        return new Range(
            (int) floor($minChargeTime + 1),
            (int) ceil($maxChargeTime - 1)
        );
    }
}
