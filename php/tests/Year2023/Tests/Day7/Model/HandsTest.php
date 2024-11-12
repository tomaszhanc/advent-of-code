<?php

declare(strict_types=1);

namespace Advent\Tests\Year2023\Tests\Day7\Model;

use Advent\Year2023\Day7\Model\GameRules\StandardRules;
use Advent\Year2023\Day7\Model\Hand;
use Advent\Year2023\Day7\Model\Hands;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class HandsTest extends TestCase
{
    #[Test]
    public function it_calculates_total_winnings(): void
    {
        $hands = new Hands(
            Hand::of('32T3K', 765),
            Hand::of('T55J5', 684),
            Hand::of('KK677', 28),
            Hand::of('KTJJT', 220),
            Hand::of('QQQJA', 483)
        );

        $this->assertEquals(6440, $hands->totalWinnings(new StandardRules()));
    }
}
