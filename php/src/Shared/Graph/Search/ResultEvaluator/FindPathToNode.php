<?php

declare(strict_types=1);

namespace Advent\Shared\Graph\Search\ResultEvaluator;

use Advent\Shared\Graph\Node;
use Advent\Shared\Graph\Search\Path;
use Advent\Shared\Graph\Search\ResultEvaluator;

final readonly class FindPathToNode implements ResultEvaluator
{
    public function __construct(
        private Node $node
    ) {
    }

    public function evaluate(Path $a, Path $b): Path
    {
        return $a->distance() > $b->distance() ? $a : $b;
    }

    public function searchCompleted(Path $currentResult): bool
    {
        return $currentResult->contains($this->node);
    }

    public function validResult(Path $result): bool
    {
        return $result->contains($this->node);
    }
}
