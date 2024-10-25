<?php

declare(strict_types=1);

namespace Advent\Tests\Year2023\Tests\Day4\Model;

use Advent\Year2023\Day4\Model\Scratchcard;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class ScratchcardTest extends TestCase
{
    #[Test]
    public function it_calculates_scratchcard_points(): void
    {
        $scratchcard = new Scratchcard(
            1,
            [41, 48, 83, 86, 17],
            [83, 86, 6, 31, 17, 9, 48, 53]
        );
        // WINNERS: 48, 83, 86, 17 => 2^3 = 8

        $this->assertEquals(8, $scratchcard->points());
    }

    #[Test]
    public function it_returns_won_scratchcard_ids(): void
    {
        $scratchcard = new Scratchcard(
            10,
            [41, 48, 83, 86, 17],
            [83, 86, 6, 31, 17, 9, 48, 53]
        );
        // WINNERS: 48, 83, 86, 17 => wins copy of cards: 11, 12, 13, 14

        $this->assertEquals([11, 12, 13, 14], $scratchcard->wonScratchcardIds());
    }
}
