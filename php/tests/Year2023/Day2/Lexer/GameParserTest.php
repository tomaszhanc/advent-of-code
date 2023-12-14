<?php

declare(strict_types=1);

namespace AoC\Year2023\Day2\Lexer;

use AoC\Year2023\Day2\Game;
use AoC\Year2023\Day2\Game\Color;
use AoC\Year2023\Day2\Game\Cubes;
use AoC\Year2023\Day2\Game\CubesSet;
use PHPUnit\Framework\TestCase;

final class GameParserTest extends TestCase
{
    /**
     * @dataProvider games
     */
    public function test_parses_a_game(string $input, Game $expectedGame): void
    {
        $parser = new GameParser();

        $this->assertEquals($expectedGame, $parser->parse($input));
    }

    public static function games(): \Iterator
    {
        yield 'Game 1' => [
            'Game 1: 3 blue, 4 red; 1 red, 2 green, 6 blue; 2 green',
            new Game(
                1,
                new CubesSet(
                    new Cubes(3, Color::BLUE),
                    new Cubes(4, Color::RED)
                ),
                new CubesSet(
                    new Cubes(1, Color::RED),
                    new Cubes(2, Color::GREEN),
                    new Cubes(6, Color::BLUE)
                ),
                new CubesSet(
                    new Cubes(2, Color::GREEN),
                )
            ),
        ];

        yield 'Game 2' => [
            'Game 2: 1 blue, 2 green; 3 green, 4 blue, 1 red; 1 green, 1 blue',
            new Game(
                2,
                new CubesSet(
                    new Cubes(1, Color::BLUE),
                    new Cubes(2, Color::GREEN)
                ),
                new CubesSet(
                    new Cubes(3, Color::GREEN),
                    new Cubes(4, Color::BLUE),
                    new Cubes(1, Color::RED)
                ),
                new CubesSet(
                    new Cubes(1, Color::GREEN),
                    new Cubes(1, Color::BLUE),
                )
            ),
        ];

        yield 'Game 3' => [
            'Game 3: 8 green, 6 blue, 20 red; 5 blue, 4 red, 13 green; 5 green, 1 red',
            new Game(
                3,
                new CubesSet(
                    new Cubes(8, Color::GREEN),
                    new Cubes(6, Color::BLUE),
                    new Cubes(20, Color::RED)
                ),
                new CubesSet(
                    new Cubes(5, Color::BLUE),
                    new Cubes(4, Color::RED),
                    new Cubes(13, Color::GREEN)
                ),
                new CubesSet(
                    new Cubes(5, Color::GREEN),
                    new Cubes(1, Color::RED),
                )
            )
        ];

        yield 'Game 4' => [
            'Game 4: 1 green, 3 red, 6 blue; 3 green, 6 red; 3 green, 15 blue, 14 red',
            new Game(
                4,
                new CubesSet(
                    new Cubes(1, Color::GREEN),
                    new Cubes(3, Color::RED),
                    new Cubes(6, Color::BLUE)
                ),
                new CubesSet(
                    new Cubes(3, Color::GREEN),
                    new Cubes(6, Color::RED),
                ),
                new CubesSet(
                    new Cubes(3, Color::GREEN),
                    new Cubes(15, Color::BLUE),
                    new Cubes(14, Color::RED),
                )
            )
        ];

        yield 'Game 5' => [
            'Game 5: 6 red, 1 blue, 3 green; 2 blue, 1 red, 2 green',
            new Game(
                5,
                new CubesSet(
                    new Cubes(6, Color::RED),
                    new Cubes(1, Color::BLUE),
                    new Cubes(3, Color::GREEN),
                ),
                new CubesSet(
                    new Cubes(2, Color::BLUE),
                    new Cubes(1, Color::RED),
                    new Cubes(2, Color::GREEN),
                ),
            )
        ];
    }


}
