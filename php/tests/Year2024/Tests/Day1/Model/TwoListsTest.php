<?php

declare(strict_types=1);

namespace Advent\Tests\Year2024\Tests\Day1\Model;

use Advent\Shared\Other\NumberList;
use Advent\Year2024\Day1\Model\TwoLists;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class TwoListsTest extends TestCase
{
    #[Test]
    public function it_calculate_total_distance(): void
    {
        $twoLists = new TwoLists(
            new NumberList(3, 4, 2, 1, 3, 3),
            new NumberList(4, 3, 5, 3, 9, 3)
        );

        $this->assertEquals(11, $twoLists->totalDistance());
    }
}
