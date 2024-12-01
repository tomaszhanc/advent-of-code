<?php

declare(strict_types=1);

namespace Advent\Tests\Shared\Other;

use Advent\Shared\Other\NumberList;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class NumberListTest extends TestCase
{
    #[Test]
    public function it_returns_number_list_sorted_ascending(): void
    {
        $unsortedNumberList = new NumberList(3, 2, 1, 4, 5);

        $this->assertEquals(
            [1, 2, 3, 4, 5],
            $unsortedNumberList->sortedAscending()
        );
    }

    #[Test]
    public function it_returns_occurrence_of_a_given_number_on_the_list(): void
    {
        $numberList = new NumberList(3, 2, 1, 4, 5, 3, 3, 3);

        $this->assertEquals(4, $numberList->occurrenceOf(3));
        $this->assertEquals(1, $numberList->occurrenceOf(2));
        $this->assertEquals(0, $numberList->occurrenceOf(10));
    }
}
