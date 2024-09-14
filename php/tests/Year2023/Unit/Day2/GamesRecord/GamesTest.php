<?php

declare(strict_types=1);

namespace Advent\Tests\Year2023\Unit\Day2\GamesRecord;

use Advent\Year2023\Day2\GamesRecord\Cubes;
use Advent\Year2023\Day2\GamesRecord\CubesSet;
use Advent\Year2023\Day2\GamesRecord\Game;
use Advent\Year2023\Day2\GamesRecord\Games;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class GamesTest extends TestCase
{
    #[Test]
    public function it_sums_games_ids(): void
    {
        $games = Games::create(
            new Game(3, CubesSet::of(Cubes::green(8))),
            new Game(4, CubesSet::of(Cubes::blue(2))),
            new Game(9, CubesSet::of(Cubes::red(33))),
        );

        $this->assertSame(16, $games->sumOfAllGameIds());
    }
}
