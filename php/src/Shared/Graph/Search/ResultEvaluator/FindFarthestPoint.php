<?php

declare(strict_types=1);

namespace Advent\Shared\Graph\Search\ResultEvaluator;

use Advent\Shared\Graph\Search\ResultEvaluator;
use Advent\Shared\Graph\Search\Path;

final readonly class FindFarthestPoint implements ResultEvaluator
{
    public function evaluate(Path $a, Path $b): Path
    {
        return $a->distance() >= $b->distance() ? $a : $b;
    }

    public function searchCompleted(Path $currentResult): bool
    {
        return false;
    }

    public function validResult(Path $result): bool
    {
        return true;
    }
}
