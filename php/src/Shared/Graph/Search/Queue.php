<?php

declare(strict_types=1);

namespace Advent\Shared\Graph\Search;

final readonly class Queue
{
    /** @var \SplQueue<Path> */
    private \SplQueue $queue;

    public function __construct()
    {
        $this->queue = new \SplQueue();
    }

    public function enqueue(Path $path): void
    {
        $this->queue->enqueue($path);
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
