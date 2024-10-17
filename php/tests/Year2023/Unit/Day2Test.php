<?php

declare(strict_types=1);

namespace Advent\Tests\Year2023\Unit;

use Advent\Year2023\Day2;
use Advent\Year2023\Day2\Model\Cubes;
use Advent\Year2023\Day2\Model\CubesSet;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class Day2Test extends TestCase
{
    private Day2 $day2;

    private string $gamesRecordFilePath;

    protected function setUp(): void
    {
        $this->day2 = Day2::create();
        $this->gamesRecordFilePath = __DIR__ . '/../../../resources/day2.txt';
    }

    #[Test]
    public function part_one_sum_all_possible_game_ids_for_the_given_cubes_set(): void
    {
        $cubeSet = CubesSet::of(
            Cubes::red(12),
            Cubes::green(13),
            Cubes::blue(14)
        );

        $this->assertEquals(2551, $this->day2->partOne_sumAllPossibleGameIds($cubeSet, $this->gamesRecordFilePath));
    }

    #[Test]
    public function part_two_sum_of_all_minimum_cubes_sets_powers(): void
    {
        $this->assertEquals(62811, $this->day2->partTwo_sumOfAllMinimumCubesSetsPowers($this->gamesRecordFilePath));
    }
}
