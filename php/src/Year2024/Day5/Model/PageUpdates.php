<?php

declare(strict_types=1);

namespace Advent\Year2024\Day5\Model;

use Advent\Shared\Other\NumberList;

final readonly class PageUpdates
{
    /** @var NumberList[] */
    private array $pageUpdates;

    public function __construct(
        NumberList ...$pageUpdates
    ) {
        $this->pageUpdates = $pageUpdates;
    }

    public function sumOfMiddleNumbersOfUpdatesInRightOrder(PriorityListFactory $priorityListFactory): int
    {
        $sum = 0;

        foreach ($this->pageUpdates as $update) {
            $priorityList = $priorityListFactory->generateFor($update);

            if ($priorityList->isInTheRightOrder($update)) {
                $sum += $update->middleNumber();
            }
        }

        return $sum;
    }

    public function sumOfMiddleNumbersOfCorrectedUpdates(PriorityListFactory $priorityListFactory): int
    {
        $sum = 0;

        foreach ($this->pageUpdates as $update) {
            $priorityList = $priorityListFactory->generateFor($update);

            if (!$priorityList->isInTheRightOrder($update)) {
                $sorted = $priorityList->sortList($update);
                $sum += $sorted->middleNumber();
            }
        }

        return $sum;
    }
}
