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

    public function enqueue(SearchResult $result): void
    {
        $this->queue->enqueue($result);
    }

    public function dequeue(): SearchResult
    {
        return $this->queue->dequeue();
    }

    public function isEmpty(): bool
    {
        return $this->queue->isEmpty();
    }
}
