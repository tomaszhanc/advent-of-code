<?php

declare(strict_types=1);

namespace Advent\Tests\Year2023\Tests\Day7\Model;

use Advent\Year2023\Day7\Model\Hand;
use Advent\Year2023\Day7\Model\HandStrengthComparator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class HandStrengthComparatorTest extends TestCase
{
    #[Test]
    #[DataProvider('scenarios')]
    public function it_compares_hands_based_on_their_strength(Hand $winner, Hand $loser): void
    {
        $comparator = new HandStrengthComparator();

        $this->assertEquals(1, $comparator($winner, $loser));
        $this->assertEquals(-1, $comparator($loser, $winner));
    }

    public static function scenarios(): iterable
    {
        yield '5 of a kind > 4 of a kind' => [
            'winner' => Hand::of('22222', 0),
            'loser'  => Hand::of('AAAAK', 0),
        ];

        yield '4 of a kind > 3 of a kind' => [
            'winner' => Hand::of('22223', 0),
            'loser'  => Hand::of('AAA23', 0),
        ];

        yield '4 of a kind > full house' => [
            'winner' => Hand::of('22223', 0),
            'loser'  => Hand::of('AAAKK', 0),
        ];

        // when types are equal, the first different card determines which hand wins
        yield [
            'winner' => Hand::of('AAAAA', 0),
            'loser'  => Hand::of('TTTTT', 0),
        ];

        yield [
            'winner' => Hand::of('333KK', 0),
            'loser'  => Hand::of('22AAA', 0),
        ];
    }
}
