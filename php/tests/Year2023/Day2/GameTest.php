<?php

declare(strict_types=1);

namespace AoC\Year2023\Day2;

use AoC\Year2023\Day2\Game\Cubes;
use AoC\Year2023\Day2\Game\CubesSet;
use PHPUnit\Framework\TestCase;

final class GameTest extends TestCase
{
    /**
     * @dataProvider games
     */
    public function test_returns_the_smallest_cube_set_that_could_have_been_used_to_play_the_game(Game $game, CubesSet $expectedTheSmallestCubeSet): void
    {
        $this->assertEqualsCanonicalizing($expectedTheSmallestCubeSet, $game->theSmallestCubeSet());
        $this->assertTrue($game->couldHaveBeenPlayedWith($game->theSmallestCubeSet()));
    }

    public static function games() : \Iterator
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
