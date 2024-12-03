<?php

declare(strict_types=1);

namespace Advent\Shared\Graph\Search;

use Advent\Shared\Graph\Node;
use Advent\Shared\InvalidArgumentException;

final readonly class Path
{
    /** @param Node[] $nodes */
    private function __construct(
        public array $nodes,
        private int $distance
    ) {
        if (count($nodes) === 0) {
            throw new InvalidArgumentException('A Path must include at least one Node.');
        }
    }

    public static function startFrom(Node $node): self
    {
        return new self([$node], distance: 0);
    }

    public function contains(Node $node): bool
    {
        return in_array($node, $this->nodes);
    }

    public function lastNode(): Node
    {
        return $this->nodes[array_key_last($this->nodes)];
    }

    public function distance(): int
    {
        return $this->distance;
    }

    public function addStep(Node $node, int $stepDistance): self
    {
        return new self(
            [...$this->nodes, $node],
            $this->distance + $stepDistance
        );
    }
}
