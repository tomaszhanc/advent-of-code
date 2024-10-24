<?php

declare(strict_types=1);

namespace Advent\Shared\Iterator;

/**
 * @template K
 * @template V
 * @template-implements \Iterator<K, V>
 */
final class LookaroundIterator implements \Iterator
{
    private $currentKey = null;
    private $lookBehindItem = null;
    private $currentItem = null;
    private $lookAheadItem = null;

    public function __construct(private \Iterator $iterator)
    {
        $this->rewind();
    }

    /** @return V */
    public function lookbehind(): mixed
    {
        return $this->lookBehindItem;
    }

    /** @return V */
    public function lookahead(): mixed
    {
        return $this->lookAheadItem;
    }

    /** @return V */
    public function current(): mixed
    {
        return $this->currentItem;
    }

    /** @return K */
    public function key(): mixed
    {
        return $this->currentKey;
    }

    public function next(): void
    {
        $this->moveForward();
    }

    public function valid(): bool
    {
        return $this->iterator->valid() || $this->currentItem !== null || $this->lookAheadItem !== null;
    }

    public function rewind(): void
    {
        $this->iterator->rewind();
        $this->moveForward();
    }

    private function moveForward(): void
    {
        $this->lookBehindItem = $this->currentItem;
        $this->currentKey = $this->iterator->key();
        $this->currentItem = $this->iterator->current();

        if ($this->iterator->valid()) {
            $this->iterator->next();
            $this->lookAheadItem = $this->iterator->current();
        } else {
            $this->lookBehindItem = null;
            $this->lookAheadItem = null;
        }
    }
}
