<?php

declare(strict_types=1);

namespace Advent\Tests\Year2023\Unit\Day2\Parser;

use Advent\Year2023\Day2\Model\Cubes;
use Advent\Year2023\Day2\Model\CubesSet;
use Advent\Year2023\Day2\Model\Game;
use Advent\Year2023\Day2\Parser\GameLexer;
use Advent\Year2023\Day2\Parser\GameParser;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class GameParserTest extends TestCase
{
    #[Test]
    #[DataProvider('scenarios')]
    public function it_parses_game_record(string $gameRecord, Game $expected): void
    {
        $parser = new GameParser(new GameLexer());

        $this->assertEquals($expected, $parser->parse($gameRecord));
    }

    public static function scenarios(): iterable
    {
        yield 'Game 1' => [
            'Game 1: 3 blue, 4 red; 1 red, 2 green, 6 blue; 2 green',
            new Game(
                1,
                CubesSet::of(
                    Cubes::blue(3),
                    Cubes::red(4)
                ),
                CubesSet::of(
                    Cubes::red(1),
                    Cubes::green(2),
                    Cubes::blue(6)
                ),
                CubesSet::of(
                    Cubes::green(2),
                )
            ),
        ];

        yield 'Game 2' => [
            'Game 2: 1 blue, 2 green; 3 green, 4 blue, 1 red; 1 green, 1 blue',
            new Game(
                2,
                CubesSet::of(
                    Cubes::blue(1),
                    Cubes::green(2)
                ),
                CubesSet::of(
                    Cubes::green(3),
                    Cubes::blue(4),
                    Cubes::red(1)
                ),
                CubesSet::of(
                    Cubes::green(1),
                    Cubes::blue(1),
                )
            ),
        ];

        yield 'Game 3' => [
            'Game 3: 8 green, 6 blue, 20 red; 5 blue, 4 red, 13 green; 5 green, 1 red',
            new Game(
                3,
                CubesSet::of(
                    Cubes::green(8),
                    Cubes::blue(6),
                    Cubes::red(20)
                ),
                CubesSet::of(
                    Cubes::blue(5),
                    Cubes::red(4),
                    Cubes::green(13)
                ),
                CubesSet::of(
                    Cubes::green(5),
                    Cubes::red(1),
                )
            ),
        ];

        yield 'Game 4' => [
            'Game 4: 1 green, 3 red, 6 blue; 3 green, 6 red; 3 green, 15 blue, 14 red',
            new Game(
                4,
                CubesSet::of(
                    Cubes::green(1),
                    Cubes::red(3),
                    Cubes::blue(6)
                ),
                CubesSet::of(
                    Cubes::green(3),
                    Cubes::red(6),
                ),
                CubesSet::of(
                    Cubes::green(3),
                    Cubes::blue(15),
                    Cubes::red(14),
                )
            ),
        ];

        yield 'Game 5' => [
            'Game 5: 6 red, 1 blue, 3 green; 2 blue, 1 red, 2 green',
            new Game(
                5,
                CubesSet::of(
                    Cubes::red(6),
                    Cubes::blue(1),
                    Cubes::green(3),
                ),
                CubesSet::of(
                    Cubes::blue(2),
                    Cubes::red(1),
                    Cubes::green(2),
                ),
            ),
        ];
    }
}
