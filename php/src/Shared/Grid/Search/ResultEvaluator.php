<?php

declare(strict_types=1);

namespace Advent\Shared\Grid\Search;

interface ResultEvaluator
{
    public function evaluate(SearchResult $current, SearchResult $candidate): bool;
}
