<?php

declare(strict_types=1);

namespace Advent\Tests\Shared\Unit\Iterator;

use Advent\Shared\Iterator\LookaroundIterator;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class LookaroundIteratorTest extends TestCase
{
    #[Test]
    public function it_has_does_not_iterate_over_empty_collection(): void
    {
        $iterator = new LookaroundIterator(new \ArrayIterator());

        $this->assertIterationCompleted($iterator);
    }

    #[Test]
    public function it_has_only_current_item_for_single_item_collection(): void
    {
        $iterator = new LookaroundIterator(new \ArrayIterator(['zero']));

        $this->assertIteratorStateEquals($iterator, key: 0, lookbehind: null, current: 'zero', lookahead: null);

        $iterator->next();
        $this->assertIterationCompleted($iterator);
    }

    #[Test]
    public function it_allows_to_look_at_items_ahead_and_behind(): void
    {
        $iterator = new LookaroundIterator(new \ArrayIterator(['zero', 'one', 'two', 'three', 'four', 'five']));

        $this->assertIteratorStateEquals($iterator, key: 0, lookbehind: null, current: 'zero', lookahead: 'one');

        $iterator->next();
        $this->assertIteratorStateEquals($iterator, key: 1, lookbehind: 'zero', current: 'one', lookahead: 'two');

        $iterator->next();
        $this->assertIteratorStateEquals($iterator, key: 2, lookbehind: 'one', current: 'two', lookahead: 'three');

        $iterator->next();
        $this->assertIteratorStateEquals($iterator, key: 3, lookbehind: 'two', current: 'three', lookahead: 'four');

        $iterator->next();
        $this->assertIteratorStateEquals($iterator, key: 4, lookbehind: 'three', current: 'four', lookahead: 'five');

        $iterator->next();
        $this->assertIteratorStateEquals($iterator, key: 5, lookbehind: 'four', current: 'five', lookahead: null);

        $iterator->next();
        $this->assertIterationCompleted($iterator);

        $iterator->rewind();
        $this->assertIteratorStateEquals($iterator, key: 0, lookbehind: null, current: 'zero', lookahead: 'one');
    }

    private function assertIteratorStateEquals(LookaroundIterator $iterator, int $key, ?string $lookbehind, string $current, ?string $lookahead): void
    {
        $this->assertTrue($iterator->valid());
        $this->assertEquals($key, $iterator->key());
        $this->assertEquals($lookbehind, $iterator->lookbehind());
        $this->assertEquals($current, $iterator->current());
        $this->assertEquals($lookahead, $iterator->lookahead());
    }

    private function assertIterationCompleted(LookaroundIterator $iterator): void
    {
        $this->assertFalse($iterator->valid());
        $this->assertNull($iterator->key());
        $this->assertNull($iterator->lookbehind());
        $this->assertNull($iterator->current());
        $this->assertNull($iterator->lookahead());
    }
}
