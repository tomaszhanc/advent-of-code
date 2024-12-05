<?php

declare(strict_types=1);

namespace Advent\Shared\Graph\Sort;

use Advent\Shared\Graph\Node;

final readonly class Queue
{
    /** @var \SplQueue<Node> */
    private \SplQueue $queue;

    public function __construct()
    {
        $this->queue = new \SplQueue();
    }

    public function enqueue(Node $node): void
    {
        $this->queue->enqueue($node);
    }

    public function dequeue(): Node
    {
        return $this->queue->dequeue();
    }

    public function isEmpty(): bool
    {
        return $this->queue->isEmpty();
    }
}
