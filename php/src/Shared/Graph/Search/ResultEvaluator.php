<?php

declare(strict_types=1);

namespace Advent\Shared\Graph\Search;

interface ResultEvaluator
{
    public function evaluate(Path $a, Path $b): Path;
}
