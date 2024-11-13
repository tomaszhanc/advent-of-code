<?php

declare(strict_types=1);

namespace Advent\Tests\Year2023\Tests\Day7\Model;

use Advent\Year2023\Day7\Model\Card;
use Advent\Year2023\Day7\Model\Hand;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class HandTest extends TestCase
{
    #[Test]
    #[DataProvider('hands')]
    public function it_replaces_jokers_with_a_given_card(Hand $hand, Card $replacementCard, Hand $expectedHand): void
    {
        $this->assertEquals($expectedHand, $hand->replaceJokersWith($replacementCard));
    }

    public static function hands(): iterable
    {
        yield [
            Hand::of('A23J4', 1),
            new Card('A'),
            Hand::of('A23A4', 1),
        ];

        yield [
            Hand::of('AJ3J4', 1),
            new Card('A'),
            Hand::of('AA3A4', 1),
        ];

        yield [
            Hand::of('JJJJJ', 1),
            new Card('A'),
            Hand::of('AAAAA', 1),
        ];
    }
}
