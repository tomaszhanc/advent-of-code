<?php

declare(strict_types=1);

namespace Advent\Shared\Grid\Search;

final readonly class Stack
{
    private \SplStack $stack;

    public function __construct()
    {
        $this->stack = new \SplStack();
    }

    public function push(Path $result): void
    {
        $this->stack->push($result);
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
