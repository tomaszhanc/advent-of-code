<?php

declare(strict_types=1);

namespace Advent\Tests\Year2023\Tests\Day2\Model;

use Advent\Year2023\Day2\Model\Cubes;
use Advent\Year2023\Day2\Model\CubesSet;
use Advent\Year2023\Day2\Model\Game;
use Advent\Year2023\Day2\Parser\GameLexer;
use Advent\Year2023\Day2\Parser\GameParser;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class GameTest extends TestCase
{
    #[Test]
    #[DataProvider('games_can_be_played_out')]
    public function it_determines_if_it_can_be_played_out_with_a_given_cubes_set(Game $game, CubesSet $cubesSet, bool $canBePlayedOut): void
    {
        $this->assertSame($canBePlayedOut, $game->canBePlayedWith($cubesSet));
    }

    public static function games_can_be_played_out(): iterable
    {
        $gameParser = new GameParser(new GameLexer());
        $cubeSet = CubesSet::of(Cubes::red(12), Cubes::green(13), Cubes::blue(14));

        yield [
            $gameParser->parse('Game 1: 3 blue, 4 red; 1 red, 2 green, 6 blue; 2 green'),
            $cubeSet,
            true,
        ];

        yield [
            $gameParser->parse('Game 2: 1 blue, 2 green; 3 green, 4 blue, 1 red; 1 green, 1 blue'),
            $cubeSet,
            true,
        ];

        yield [
            $gameParser->parse('Game 3: 8 green, 6 blue, 20 red; 5 blue, 4 red, 13 green; 5 green, 1 red'),
            $cubeSet,
            false,
        ];

        yield [
            $gameParser->parse('Game 4: 1 green, 3 red, 6 blue; 3 green, 6 red; 3 green, 15 blue, 14 red'),
            $cubeSet,
            false,
        ];

        yield [
            $gameParser->parse('Game 5: 6 red, 1 blue, 3 green; 2 blue, 1 red, 2 green'),
            $cubeSet,
            true,
        ];
    }

    #[Test]
    #[DataProvider('games_smallest_cube_set')]
    public function it_finds_the_smallest_cube_set_required_to_play_the_game(Game $game, CubesSet $expectedSmallestCubeSet): void
    {
        $this->assertEqualsCanonicalizing($expectedSmallestCubeSet, $game->findSmallestCubesSetToPlay());
        $this->assertTrue($game->canBePlayedWith($game->findSmallestCubesSetToPlay()));
    }

    public static function games_smallest_cube_set(): iterable
    {
        yield [
            new Game(
                1,
                CubesSet::of(Cubes::blue(3), Cubes::red(4)),
                CubesSet::of(Cubes::red(1), Cubes::green(2), Cubes::blue(6)),
                CubesSet::of(Cubes::green(2))
            ),
            CubesSet::of(Cubes::red(4), Cubes::green(2), Cubes::blue(6)),
        ];

        yield [
            new Game(
                2,
                CubesSet::of(Cubes::blue(1), Cubes::green(2)),
                CubesSet::of(Cubes::green(3), Cubes::blue(4), Cubes::red(1)),
                CubesSet::of(Cubes::green(1), Cubes::blue(1))
            ),
            CubesSet::of(Cubes::red(1), Cubes::green(3), Cubes::blue(4)),
        ];

        yield [
            new Game(
                3,
                CubesSet::of(Cubes::green(8), Cubes::blue(6), Cubes::red(20)),
                CubesSet::of(Cubes::blue(5), Cubes::red(4), Cubes::green(13)),
                CubesSet::of(Cubes::green(5), Cubes::red(1))
            ),
            CubesSet::of(Cubes::red(20), Cubes::green(13), Cubes::blue(6)),
        ];

        yield [
            new Game(
                4,
                CubesSet::of(Cubes::green(1), Cubes::red(3), Cubes::blue(6)),
                CubesSet::of(Cubes::green(3), Cubes::red(6)),
                CubesSet::of(Cubes::green(3), Cubes::blue(15), Cubes::red(14))
            ),
            CubesSet::of(Cubes::red(14), Cubes::green(3), Cubes::blue(15)),
        ];

        yield [
            new Game(
                5,
                CubesSet::of(Cubes::red(6), Cubes::blue(1), Cubes::green(3)),
                CubesSet::of(Cubes::blue(2), Cubes::red(1), Cubes::green(2))
            ),
            CubesSet::of(Cubes::red(6), Cubes::green(3), Cubes::blue(2)),
        ];
    }
}
