<?php

namespace Advent\Tests\Year2023\Unit\Day2;

use Advent\Year2023\Day2\GameParserDeprecated;
use Advent\Year2023\Day2\GamesRecord;
use Advent\Year2023\Day2\GamesRecord\Cubes;
use Advent\Year2023\Day2\GamesRecord\CubesSet;
use Advent\Year2023\Day2\GamesRecord\Games;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class GamesRecordTest extends TestCase
{
    #[Test]
    public function it_returns_all_games_possible_to_be_played_out_with_a_given_cubes_set(): void
    {
        $gameParser = new GameParserDeprecated();
        $gamesRecord = GamesRecord::withGames([
            $game1 = $gameParser->parse('Game 1: 3 blue, 4 red; 1 red, 2 green, 6 blue; 2 green'),
            $game2 = $gameParser->parse('Game 2: 1 blue, 2 green; 3 green, 4 blue, 1 red; 1 green, 1 blue'),
            $gameParser->parse('Game 3: 8 green, 6 blue, 20 red; 5 blue, 4 red, 13 green; 5 green, 1 red'),
            $gameParser->parse('Game 4: 1 green, 3 red, 6 blue; 3 green, 6 red; 3 green, 15 blue, 14 red'),
            $game5 = $gameParser->parse('Game 5: 6 red, 1 blue, 3 green; 2 blue, 1 red, 2 green'),
        ]);
        $cubeSet = CubesSet::of(Cubes::red(12), Cubes::green(13), Cubes::blue(14));

        $this->assertEquals(
            Games::create($game1, $game2, $game5),
            $gamesRecord->possibleGamesFor($cubeSet)
        );
    }

    #[Test]
    public function it_sums_all_game_ids_that_are_possible_to_be_played_out_with_a_given_cubes_set(): void
    {
        $gameParser = new GameParserDeprecated();
        $gamesRecord = GamesRecord::withGames([
            $gameParser->parse('Game 1: 3 blue, 4 red; 1 red, 2 green, 6 blue; 2 green'),
            $gameParser->parse('Game 2: 1 blue, 2 green; 3 green, 4 blue, 1 red; 1 green, 1 blue'),
            $gameParser->parse('Game 3: 8 green, 6 blue, 20 red; 5 blue, 4 red, 13 green; 5 green, 1 red'),
            $gameParser->parse('Game 4: 1 green, 3 red, 6 blue; 3 green, 6 red; 3 green, 15 blue, 14 red'),
            $gameParser->parse('Game 5: 6 red, 1 blue, 3 green; 2 blue, 1 red, 2 green'),
        ]);
        $cubeSet = CubesSet::of(Cubes::red(12), Cubes::green(13), Cubes::blue(14));

        $this->assertEquals(
            8, // only games 1, 2 and 5 are possible
            $gamesRecord->sumOfPossibleGameIdsFor($cubeSet)
        );
    }
}
