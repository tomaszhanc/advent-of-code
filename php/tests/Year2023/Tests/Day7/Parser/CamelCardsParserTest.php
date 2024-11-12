<?php

declare(strict_types=1);

namespace Advent\Tests\Year2023\Tests\Day7\Parser;

use Advent\Shared\Lexer\Lexer;
use Advent\Year2023\Day7\Model\Hand;
use Advent\Year2023\Day7\Model\Card;
use Advent\Year2023\Day7\Parser\CamelCardsParser;
use Advent\Year2023\Day7\Parser\CamelCardsType;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class CamelCardsParserTest extends TestCase
{
    #[Test]
    #[DataProvider('cards')]
    public function it_parses_camel_cards(string $input, Hand $camelHand): void
    {
        $parser = new CamelCardsParser();

        $this->assertEquals($camelHand, $parser->parse($input));
    }

    public static function cards(): iterable
    {
        yield [
            '32T3K 765',
            new Hand(
                765,
                new Card('3'),
                new Card('2'),
                new Card('T'),
                new Card('3'),
                new Card('K'),
            ),
        ];

        yield [
            'T55J5 684',
            new Hand(
                684,
                new Card('T'),
                new Card('5'),
                new Card('5'),
                new Card('J'),
                new Card('5')
            ),
        ];

        yield [
            'KK677 28',
            new Hand(
                28,
                new Card('K'),
                new Card('K'),
                new Card('6'),
                new Card('7'),
                new Card('7'),
            ),
        ];

        yield [
            'KTJJT 220',
            new Hand(
                220,
                new Card('K'),
                new Card('T'),
                new Card('J'),
                new Card('J'),
                new Card('T'),
            ),
        ];

        yield [
            'QQQJA 483',
            new Hand(
                483,
                new Card('Q'),
                new Card('Q'),
                new Card('Q'),
                new Card('J'),
                new Card('A'),
            ),
        ];
    }
}
