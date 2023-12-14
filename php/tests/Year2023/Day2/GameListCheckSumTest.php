<?php

declare(strict_types=1);

namespace AoC\Year2023\Day2;

use AoC\Common\Filesystem\SimpleFilesystem;
use AoC\Year2023\Day2\Game\Cubes;
use AoC\Year2023\Day2\Game\CubesSet;
use AoC\Year2023\Day2\Lexer\GameParser;
use PHPUnit\Framework\TestCase;

final class GameListCheckSumTest extends TestCase
{
    public function test_returns_the_sum_of_game_identifiers_that_could_have_been_played_with_the_given_cubes_set(): void
    {
        $validator = new GameListCheckSum(new SimpleFilesystem(), new GameParser());

        $this->assertEquals(
            2551        ,
            $validator->checkSumOf(
                __DIR__ . '/../Resources/day2.txt',
                new CubesSet(
                    Cubes::red(12),
                    Cubes::green(13),
                    Cubes::blue(14)
                )
            )
        );
    }
}
