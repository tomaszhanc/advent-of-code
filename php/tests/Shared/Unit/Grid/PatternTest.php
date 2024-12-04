<?php

declare(strict_types=1);

namespace Advent\Tests\Shared\Unit\Grid;

use Advent\Shared\Grid\Pattern;
use Advent\Shared\Grid\Pattern\PatternCell;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class PatternTest extends TestCase
{
    #[Test]
    public function it_creates_pattern_from_array(): void
    {
        $this->assertEquals(
            new Pattern(
                new PatternCell(x: 0, y: 0, value: 'M'),
                new PatternCell(x: 1, y: 0, value: '.'),
                new PatternCell(x: 2, y: 0, value: 'S'),
                new PatternCell(x: 0, y: 1, value: '.'),
                new PatternCell(x: 1, y: 1, value: 'A'),
                new PatternCell(x: 2, y: 1, value: '.'),
                new PatternCell(x: 0, y: 2, value: 'M'),
                new PatternCell(x: 1, y: 2, value: '.'),
                new PatternCell(x: 2, y: 2, value: 'S'),
            ),
            Pattern::fromArray([
                ['M', '.', 'S'],
                ['.', 'A', '.'],
                ['M', '.', 'S'],
            ])
        );
    }
}
