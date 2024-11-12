<?php

declare(strict_types=1);

namespace Advent\Tests\Year2023\Tests\Day7\Model;

use Advent\Year2023\Day7\Model\Hand;
use Advent\Year2023\Day7\Model\HandType;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class HandTest extends TestCase
{
    #[Test]
    #[DataProvider('hands')]
    public function it_returns_hand_type(string $hand, HandType $type): void
    {
        $this->assertEquals($type, Hand::of($hand, 0)->type());
    }

    public static function hands(): iterable
    {
        yield ['AAAAA', HandType::FIVE_OF_A_KIND];
        yield ['AA8AA', HandType::FOUR_OF_A_KIND];
        yield ['23332', HandType::FULL_HOUSE];
        yield ['23432', HandType::TWO_PAIR];
        yield ['A23A4', HandType::ONE_PAIR];
        yield ['23456', HandType::HIGH_CARD];
    }
}
