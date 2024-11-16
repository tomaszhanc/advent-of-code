<?php

declare(strict_types=1);

namespace Advent\Tests\Year2023\Tests\Day9\Model;

use Advent\Year2023\Day9\Model\Sequence;
use Advent\Year2023\Day9\Model\SequenceExtrapolation;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class SequenceExtrapolationTest extends TestCase
{
    #[Test]
    public function it_extrapolates_next_value(): void
    {
        $sequenceExtrapolation = new SequenceExtrapolation();

        $this->assertEquals(18, $sequenceExtrapolation->nextExtrapolatedValue(new Sequence(0, 3, 6, 9, 12, 15)));
        $this->assertEquals(28, $sequenceExtrapolation->nextExtrapolatedValue(new Sequence(1, 3, 6, 10, 15, 21)));
        $this->assertEquals(68, $sequenceExtrapolation->nextExtrapolatedValue(new Sequence(10, 13, 16, 21, 30, 45)));
    }

    #[Test]
    public function it_extrapolates_previous_value(): void
    {
        $sequenceExtrapolation = new SequenceExtrapolation();

        $this->assertEquals(-3, $sequenceExtrapolation->previousExtrapolatedValue(new Sequence(0, 3, 6, 9, 12, 15)));
        $this->assertEquals(0, $sequenceExtrapolation->previousExtrapolatedValue(new Sequence(1, 3, 6, 10, 15, 21)));
        $this->assertEquals(5, $sequenceExtrapolation->previousExtrapolatedValue(new Sequence(10, 13, 16, 21, 30, 45)));
    }
}
