<?php

declare(strict_types=1);

namespace Advent\Shared\Grid\Search;

interface ResultEvaluator
{
    public function evaluate(Path $a, Path $b): Path;
}
