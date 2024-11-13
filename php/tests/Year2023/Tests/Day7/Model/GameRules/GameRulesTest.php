<?php

declare(strict_types=1);

namespace Advent\Tests\Year2023\Tests\Day7\Model\GameRules;

use Advent\Year2023\Day7\Model\Card;
use Advent\Year2023\Day7\Model\GameRules\JokerInPlay;
use Advent\Year2023\Day7\Model\GameRules\StandardRules;
use Advent\Year2023\Day7\Model\Hand;
use Advent\Year2023\Day7\Model\HandStrength;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class GameRulesTest extends TestCase
{
    #[Test]
    public function it_treats_j_as_jack_which_is_stronger_than_deuce(): void
    {
        $rules = new StandardRules();

        $this->assertGreaterThan(
            $rules->cardStrength(new Card('2')),
            $rules->cardStrength(new Card('J'))
        );
    }

    #[Test]
    public function it_treats_j_as_joker_which_is_weaker_than_deuce(): void
    {
        $rules = new JokerInPlay();

        $this->assertLessThan(
            $rules->cardStrength(new Card('2')),
            $rules->cardStrength(new Card('J'))
        );
    }

    #[Test]
    #[DataProvider('hand_strengths')]
    public function it_determines_hand_strength(string $hand, HandStrength $expectedHandStrength): void
    {
        $rules = new StandardRules();

        $this->assertEquals($expectedHandStrength, $rules->handStrength(Hand::of($hand, 1)));
    }

    public static function hand_strengths(): iterable
    {
        yield ['AAAAA', HandStrength::FIVE_OF_A_KIND];
        yield ['JJJJJ', HandStrength::FIVE_OF_A_KIND];
        yield ['AA8AA', HandStrength::FOUR_OF_A_KIND];
        yield ['23332', HandStrength::FULL_HOUSE];
        yield ['T55J5', HandStrength::THREE_OF_A_KIND];
        yield ['QQQJA', HandStrength::THREE_OF_A_KIND];
        yield ['23432', HandStrength::TWO_PAIR];
        yield ['KK677', HandStrength::TWO_PAIR];
        yield ['KTJJT', HandStrength::TWO_PAIR];
        yield ['A23A4', HandStrength::ONE_PAIR];
        yield ['23456', HandStrength::HIGH_CARD];
        yield ['32T3K', HandStrength::ONE_PAIR];
    }

    #[Test]
    #[DataProvider('hand_strengths_when_joker_is_in_play')]
    public function it_determines_hand_strength_when_joker_is_in_play(string $hand, HandStrength $expectedHandStrength): void
    {
        $rules = new JokerInPlay();

        $this->assertEquals($expectedHandStrength, $rules->handStrength(Hand::of($hand, 1)));
    }

    public static function hand_strengths_when_joker_is_in_play(): iterable
    {
        yield ['AAAAA', HandStrength::FIVE_OF_A_KIND];
        yield ['JJJJJ', HandStrength::FIVE_OF_A_KIND];
        yield ['444J4', HandStrength::FIVE_OF_A_KIND];
        yield ['4J4J4', HandStrength::FIVE_OF_A_KIND];
        yield ['4J4JJ', HandStrength::FIVE_OF_A_KIND];
        yield ['JJ4JJ', HandStrength::FIVE_OF_A_KIND];
        yield ['AA8AA', HandStrength::FOUR_OF_A_KIND];
        yield ['T55J5', HandStrength::FOUR_OF_A_KIND];
        yield ['QQQJA', HandStrength::FOUR_OF_A_KIND];
        yield ['KTJJT', HandStrength::FOUR_OF_A_KIND];
        yield ['23332', HandStrength::FULL_HOUSE];
        yield ['23432', HandStrength::TWO_PAIR];
        yield ['KK677', HandStrength::TWO_PAIR];
        yield ['A23A4', HandStrength::ONE_PAIR];
        yield ['32T3K', HandStrength::ONE_PAIR];
        yield ['23456', HandStrength::HIGH_CARD];
    }
}
