<?php

declare(strict_types=1);

namespace Advent\Year2023\Day8\Model;

final class Instructions implements \Iterator
{
    /** @var Direction[] */
    private readonly array $moves;

    private readonly int $maxKey;

    private int $key;

    public function __construct(Direction ...$moves)
    {
        $this->moves = $moves;
        $this->maxKey = count($moves) - 1;
        $this->key = 0;
    }

    public function key(): int
    {
        return $this->key;
    }

    public function current(): Direction
    {
        return $this->moves[$this->key];
    }

    public function next(): void
    {
        if ($this->key === $this->maxKey) {
            $this->rewind();
            return;
        }

        $this->key++;
    }

    public function rewind(): void
    {
        $this->key = 0;
    }

    public function valid(): bool
    {
        return true;
    }
}
