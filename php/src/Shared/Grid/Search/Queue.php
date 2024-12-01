<?php

declare(strict_types=1);

namespace Advent\Shared\Grid\Search;

final readonly class Queue
{
    private \SplQueue $queue;

    public function __construct()
    {
        $this->queue = new \SplQueue();
    }

    public function enqueue(Path $result): void
    {
        $this->queue->enqueue($result);
    }

    public function dequeue(): Path
    {
        return $this->queue->dequeue();
    }

    public function isEmpty(): bool
    {
        return $this->queue->isEmpty();
    }
}
