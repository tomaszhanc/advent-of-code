<?php

declare(strict_types=1);

namespace AoC\Year2023\Tests\Day2\GamesRecord;

use AoC\Year2023\Day2\GamesRecord\Cubes;
use AoC\Year2023\Day2\GamesRecord\CubesSet;
use AoC\Year2023\Day2\GamesRecord\Game;
use AoC\Year2023\Day2\GamesRecord\Games;
use PHPUnit\Framework\TestCase;

final class GamesTest extends TestCase
{
    public function test_sums_games_ids(): void
    {
        $games = Games::create(
            new Game(3, CubesSet::of(Cubes::green(8))),
            new Game(4, CubesSet::of(Cubes::blue(2))),
            new Game(9, CubesSet::of(Cubes::red(33))),
        );

        $this->assertSame(16, $games->sumOfAllGameIds());
    }
}
