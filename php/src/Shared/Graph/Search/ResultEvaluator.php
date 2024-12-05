<?php

declare(strict_types=1);

namespace Advent\Shared\Graph\Search;

interface ResultEvaluator // TODO this interface is wrongly designed
{
    public function evaluate(Path $a, Path $b): Path;

    public function searchCompleted(Path $currentResult): bool;

    public function validResult(Path $result): bool;
}
