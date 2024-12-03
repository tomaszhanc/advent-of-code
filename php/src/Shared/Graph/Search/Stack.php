<?php

declare(strict_types=1);

namespace Advent\Shared\Graph\Search;

final readonly class Stack
{
    /** @var \SplStack<Path> */
    private \SplStack $stack;

    public function __construct()
    {
        $this->stack = new \SplStack();
    }

    public function push(Path $path): void
    {
        $this->stack->push($path);
    }

    public function pop(): Path
    {
        return $this->stack->pop();
    }

    public function isEmpty(): bool
    {
        return $this->stack->isEmpty();
    }
}
