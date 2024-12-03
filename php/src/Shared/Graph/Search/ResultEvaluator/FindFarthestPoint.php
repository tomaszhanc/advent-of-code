<?php

declare(strict_types=1);

namespace Advent\Shared\Graph\Search\ResultEvaluator;

use Advent\Shared\Graph\Search\ResultEvaluator;
use Advent\Shared\Graph\Search\Path;

final readonly class FindFarthestPoint implements ResultEvaluator // fixme rename interface
{
    public function evaluate(Path $a, Path $b): Path
    {
        return $a->distance() >= $b->distance() ? $a : $b;
    }
}
