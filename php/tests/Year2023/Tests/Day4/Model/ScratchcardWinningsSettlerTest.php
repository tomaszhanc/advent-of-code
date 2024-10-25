<?php

declare(strict_types=1);

namespace Advent\Tests\Year2023\Tests\Day4\Model;

use Advent\Year2023\Day4\Model\Scratchcard;
use Advent\Year2023\Day4\Model\ScratchcardWinningsSettler;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class ScratchcardWinningsSettlerTest extends TestCase
{
    #[Test]
    public function it_settle_winnings(): void
    {
        $counter = new ScratchcardWinningsSettler();
        $scratchcard = new Scratchcard(
            10,
            [41, 48, 83, 86, 17],
            [83, 86, 6, 31, 17, 9, 48, 53] // WINNERS: 48, 83, 86, 17
        );

        $counter->settleWinningsFor($scratchcard);

        $this->assertEquals(1 + 4, $counter->total());
    }
}
