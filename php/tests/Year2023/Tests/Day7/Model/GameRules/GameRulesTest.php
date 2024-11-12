<?php

declare(strict_types=1);

namespace Advent\Tests\Year2023\Tests\Day7\Model\GameRules;

use Advent\Year2023\Day7\Model\Card;
use Advent\Year2023\Day7\Model\GameRules\JokerInPlay;
use Advent\Year2023\Day7\Model\GameRules\StandardRules;
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
}
