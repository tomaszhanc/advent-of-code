<?php

declare(strict_types=1);

namespace Advent\Shared\Grid\Search\ResultEvaluator;

use Advent\Shared\Grid\Search\ResultEvaluator;
use Advent\Shared\Grid\Search\SearchResult;

final readonly class FindFarthestPoint implements ResultEvaluator // fixme rename interface
{
    public function evaluate(SearchResult $current, SearchResult $candidate): bool
    {
        return $candidate->distance() >= $current->distance();
    }
}
